
(function(l, r) { if (!l || l.getElementById('livereloadscript')) return; r = l.createElement('script'); r.async = 1; r.src = '//' + (self.location.host || 'localhost').split(':')[0] + ':35729/livereload.js?snipver=1'; r.id = 'livereloadscript'; l.getElementsByTagName('head')[0].appendChild(r) })(self.document);
var EMB = (function () {
    'use strict';

    function noop() { }
    function add_location(element, file, line, column, char) {
        element.__svelte_meta = {
            loc: { file, line, column, char }
        };
    }
    function run(fn) {
        return fn();
    }
    function blank_object() {
        return Object.create(null);
    }
    function run_all(fns) {
        fns.forEach(run);
    }
    function is_function(thing) {
        return typeof thing === 'function';
    }
    function safe_not_equal(a, b) {
        return a != a ? b == b : a !== b || ((a && typeof a === 'object') || typeof a === 'function');
    }
    function is_empty(obj) {
        return Object.keys(obj).length === 0;
    }
    function append(target, node) {
        target.appendChild(node);
    }
    function insert(target, node, anchor) {
        target.insertBefore(node, anchor || null);
    }
    function detach(node) {
        if (node.parentNode) {
            node.parentNode.removeChild(node);
        }
    }
    function destroy_each(iterations, detaching) {
        for (let i = 0; i < iterations.length; i += 1) {
            if (iterations[i])
                iterations[i].d(detaching);
        }
    }
    function element(name) {
        return document.createElement(name);
    }
    function text(data) {
        return document.createTextNode(data);
    }
    function space() {
        return text(' ');
    }
    function empty() {
        return text('');
    }
    function listen(node, event, handler, options) {
        node.addEventListener(event, handler, options);
        return () => node.removeEventListener(event, handler, options);
    }
    function attr(node, attribute, value) {
        if (value == null)
            node.removeAttribute(attribute);
        else if (node.getAttribute(attribute) !== value)
            node.setAttribute(attribute, value);
    }
    function children(element) {
        return Array.from(element.childNodes);
    }
    function set_style(node, key, value, important) {
        if (value === null) {
            node.style.removeProperty(key);
        }
        else {
            node.style.setProperty(key, value, important ? 'important' : '');
        }
    }
    function custom_event(type, detail, { bubbles = false, cancelable = false } = {}) {
        const e = document.createEvent('CustomEvent');
        e.initCustomEvent(type, bubbles, cancelable, detail);
        return e;
    }

    let current_component;
    function set_current_component(component) {
        current_component = component;
    }

    const dirty_components = [];
    const binding_callbacks = [];
    const render_callbacks = [];
    const flush_callbacks = [];
    const resolved_promise = Promise.resolve();
    let update_scheduled = false;
    function schedule_update() {
        if (!update_scheduled) {
            update_scheduled = true;
            resolved_promise.then(flush);
        }
    }
    function add_render_callback(fn) {
        render_callbacks.push(fn);
    }
    function add_flush_callback(fn) {
        flush_callbacks.push(fn);
    }
    // flush() calls callbacks in this order:
    // 1. All beforeUpdate callbacks, in order: parents before children
    // 2. All bind:this callbacks, in reverse order: children before parents.
    // 3. All afterUpdate callbacks, in order: parents before children. EXCEPT
    //    for afterUpdates called during the initial onMount, which are called in
    //    reverse order: children before parents.
    // Since callbacks might update component values, which could trigger another
    // call to flush(), the following steps guard against this:
    // 1. During beforeUpdate, any updated components will be added to the
    //    dirty_components array and will cause a reentrant call to flush(). Because
    //    the flush index is kept outside the function, the reentrant call will pick
    //    up where the earlier call left off and go through all dirty components. The
    //    current_component value is saved and restored so that the reentrant call will
    //    not interfere with the "parent" flush() call.
    // 2. bind:this callbacks cannot trigger new flush() calls.
    // 3. During afterUpdate, any updated components will NOT have their afterUpdate
    //    callback called a second time; the seen_callbacks set, outside the flush()
    //    function, guarantees this behavior.
    const seen_callbacks = new Set();
    let flushidx = 0; // Do *not* move this inside the flush() function
    function flush() {
        const saved_component = current_component;
        do {
            // first, call beforeUpdate functions
            // and update components
            while (flushidx < dirty_components.length) {
                const component = dirty_components[flushidx];
                flushidx++;
                set_current_component(component);
                update(component.$$);
            }
            set_current_component(null);
            dirty_components.length = 0;
            flushidx = 0;
            while (binding_callbacks.length)
                binding_callbacks.pop()();
            // then, once components are updated, call
            // afterUpdate functions. This may cause
            // subsequent updates...
            for (let i = 0; i < render_callbacks.length; i += 1) {
                const callback = render_callbacks[i];
                if (!seen_callbacks.has(callback)) {
                    // ...so guard against infinite loops
                    seen_callbacks.add(callback);
                    callback();
                }
            }
            render_callbacks.length = 0;
        } while (dirty_components.length);
        while (flush_callbacks.length) {
            flush_callbacks.pop()();
        }
        update_scheduled = false;
        seen_callbacks.clear();
        set_current_component(saved_component);
    }
    function update($$) {
        if ($$.fragment !== null) {
            $$.update();
            run_all($$.before_update);
            const dirty = $$.dirty;
            $$.dirty = [-1];
            $$.fragment && $$.fragment.p($$.ctx, dirty);
            $$.after_update.forEach(add_render_callback);
        }
    }
    const outroing = new Set();
    let outros;
    function group_outros() {
        outros = {
            r: 0,
            c: [],
            p: outros // parent group
        };
    }
    function check_outros() {
        if (!outros.r) {
            run_all(outros.c);
        }
        outros = outros.p;
    }
    function transition_in(block, local) {
        if (block && block.i) {
            outroing.delete(block);
            block.i(local);
        }
    }
    function transition_out(block, local, detach, callback) {
        if (block && block.o) {
            if (outroing.has(block))
                return;
            outroing.add(block);
            outros.c.push(() => {
                outroing.delete(block);
                if (callback) {
                    if (detach)
                        block.d(1);
                    callback();
                }
            });
            block.o(local);
        }
        else if (callback) {
            callback();
        }
    }

    function bind(component, name, callback, value) {
        const index = component.$$.props[name];
        if (index !== undefined) {
            component.$$.bound[index] = callback;
            if (value === undefined) {
                callback(component.$$.ctx[index]);
            }
        }
    }
    function create_component(block) {
        block && block.c();
    }
    function mount_component(component, target, anchor, customElement) {
        const { fragment, after_update } = component.$$;
        fragment && fragment.m(target, anchor);
        if (!customElement) {
            // onMount happens before the initial afterUpdate
            add_render_callback(() => {
                const new_on_destroy = component.$$.on_mount.map(run).filter(is_function);
                // if the component was destroyed immediately
                // it will update the `$$.on_destroy` reference to `null`.
                // the destructured on_destroy may still reference to the old array
                if (component.$$.on_destroy) {
                    component.$$.on_destroy.push(...new_on_destroy);
                }
                else {
                    // Edge case - component was destroyed immediately,
                    // most likely as a result of a binding initialising
                    run_all(new_on_destroy);
                }
                component.$$.on_mount = [];
            });
        }
        after_update.forEach(add_render_callback);
    }
    function destroy_component(component, detaching) {
        const $$ = component.$$;
        if ($$.fragment !== null) {
            run_all($$.on_destroy);
            $$.fragment && $$.fragment.d(detaching);
            // TODO null out other refs, including component.$$ (but need to
            // preserve final state?)
            $$.on_destroy = $$.fragment = null;
            $$.ctx = [];
        }
    }
    function make_dirty(component, i) {
        if (component.$$.dirty[0] === -1) {
            dirty_components.push(component);
            schedule_update();
            component.$$.dirty.fill(0);
        }
        component.$$.dirty[(i / 31) | 0] |= (1 << (i % 31));
    }
    function init(component, options, instance, create_fragment, not_equal, props, append_styles, dirty = [-1]) {
        const parent_component = current_component;
        set_current_component(component);
        const $$ = component.$$ = {
            fragment: null,
            ctx: [],
            // state
            props,
            update: noop,
            not_equal,
            bound: blank_object(),
            // lifecycle
            on_mount: [],
            on_destroy: [],
            on_disconnect: [],
            before_update: [],
            after_update: [],
            context: new Map(options.context || (parent_component ? parent_component.$$.context : [])),
            // everything else
            callbacks: blank_object(),
            dirty,
            skip_bound: false,
            root: options.target || parent_component.$$.root
        };
        append_styles && append_styles($$.root);
        let ready = false;
        $$.ctx = instance
            ? instance(component, options.props || {}, (i, ret, ...rest) => {
                const value = rest.length ? rest[0] : ret;
                if ($$.ctx && not_equal($$.ctx[i], $$.ctx[i] = value)) {
                    if (!$$.skip_bound && $$.bound[i])
                        $$.bound[i](value);
                    if (ready)
                        make_dirty(component, i);
                }
                return ret;
            })
            : [];
        $$.update();
        ready = true;
        run_all($$.before_update);
        // `false` as a special case of no DOM component
        $$.fragment = create_fragment ? create_fragment($$.ctx) : false;
        if (options.target) {
            if (options.hydrate) {
                const nodes = children(options.target);
                // eslint-disable-next-line @typescript-eslint/no-non-null-assertion
                $$.fragment && $$.fragment.l(nodes);
                nodes.forEach(detach);
            }
            else {
                // eslint-disable-next-line @typescript-eslint/no-non-null-assertion
                $$.fragment && $$.fragment.c();
            }
            if (options.intro)
                transition_in(component.$$.fragment);
            mount_component(component, options.target, options.anchor, options.customElement);
            flush();
        }
        set_current_component(parent_component);
    }
    /**
     * Base class for Svelte components. Used when dev=false.
     */
    class SvelteComponent {
        $destroy() {
            destroy_component(this, 1);
            this.$destroy = noop;
        }
        $on(type, callback) {
            if (!is_function(callback)) {
                return noop;
            }
            const callbacks = (this.$$.callbacks[type] || (this.$$.callbacks[type] = []));
            callbacks.push(callback);
            return () => {
                const index = callbacks.indexOf(callback);
                if (index !== -1)
                    callbacks.splice(index, 1);
            };
        }
        $set($$props) {
            if (this.$$set && !is_empty($$props)) {
                this.$$.skip_bound = true;
                this.$$set($$props);
                this.$$.skip_bound = false;
            }
        }
    }

    function dispatch_dev(type, detail) {
        document.dispatchEvent(custom_event(type, Object.assign({ version: '3.54.0' }, detail), { bubbles: true }));
    }
    function append_dev(target, node) {
        dispatch_dev('SvelteDOMInsert', { target, node });
        append(target, node);
    }
    function insert_dev(target, node, anchor) {
        dispatch_dev('SvelteDOMInsert', { target, node, anchor });
        insert(target, node, anchor);
    }
    function detach_dev(node) {
        dispatch_dev('SvelteDOMRemove', { node });
        detach(node);
    }
    function listen_dev(node, event, handler, options, has_prevent_default, has_stop_propagation) {
        const modifiers = options === true ? ['capture'] : options ? Array.from(Object.keys(options)) : [];
        if (has_prevent_default)
            modifiers.push('preventDefault');
        if (has_stop_propagation)
            modifiers.push('stopPropagation');
        dispatch_dev('SvelteDOMAddEventListener', { node, event, handler, modifiers });
        const dispose = listen(node, event, handler, options);
        return () => {
            dispatch_dev('SvelteDOMRemoveEventListener', { node, event, handler, modifiers });
            dispose();
        };
    }
    function attr_dev(node, attribute, value) {
        attr(node, attribute, value);
        if (value == null)
            dispatch_dev('SvelteDOMRemoveAttribute', { node, attribute });
        else
            dispatch_dev('SvelteDOMSetAttribute', { node, attribute, value });
    }
    function prop_dev(node, property, value) {
        node[property] = value;
        dispatch_dev('SvelteDOMSetProperty', { node, property, value });
    }
    function set_data_dev(text, data) {
        data = '' + data;
        if (text.wholeText === data)
            return;
        dispatch_dev('SvelteDOMSetData', { node: text, data });
        text.data = data;
    }
    function validate_each_argument(arg) {
        if (typeof arg !== 'string' && !(arg && typeof arg === 'object' && 'length' in arg)) {
            let msg = '{#each} only iterates over array-like objects.';
            if (typeof Symbol === 'function' && arg && Symbol.iterator in arg) {
                msg += ' You can use a spread to convert this iterable into an array.';
            }
            throw new Error(msg);
        }
    }
    function validate_slots(name, slot, keys) {
        for (const slot_key of Object.keys(slot)) {
            if (!~keys.indexOf(slot_key)) {
                console.warn(`<${name}> received an unexpected slot "${slot_key}".`);
            }
        }
    }
    function construct_svelte_component_dev(component, props) {
        const error_message = 'this={...} of <svelte:component> should specify a Svelte component.';
        try {
            const instance = new component(props);
            if (!instance.$$ || !instance.$set || !instance.$on || !instance.$destroy) {
                throw new Error(error_message);
            }
            return instance;
        }
        catch (err) {
            const { message } = err;
            if (typeof message === 'string' && message.indexOf('is not a constructor') !== -1) {
                throw new Error(error_message);
            }
            else {
                throw err;
            }
        }
    }
    /**
     * Base class for Svelte components with some minor dev-enhancements. Used when dev=true.
     */
    class SvelteComponentDev extends SvelteComponent {
        constructor(options) {
            if (!options || (!options.target && !options.$$inline)) {
                throw new Error("'target' is a required option");
            }
            super();
        }
        $destroy() {
            super.$destroy();
            this.$destroy = () => {
                console.warn('Component was already destroyed'); // eslint-disable-line no-console
            };
        }
        $capture_state() { }
        $inject_state() { }
    }

    /* src\formItems\EmailItem.svelte generated by Svelte v3.54.0 */

    const file$5 = "src\\formItems\\EmailItem.svelte";

    function create_fragment$5(ctx) {
    	let div8;
    	let div3;
    	let span;
    	let t1;
    	let div2;
    	let div0;
    	let i0;
    	let t2;
    	let div1;
    	let i1;
    	let t3;
    	let div5;
    	let label0;
    	let t5;
    	let div4;
    	let input0;
    	let input0_name_value;
    	let t6;
    	let div7;
    	let label1;
    	let t8;
    	let div6;
    	let input1;
    	let input1_name_value;
    	let t9;
    	let input2;
    	let input2_name_value;
    	let input2_checked_value;
    	let mounted;
    	let dispose;

    	const block = {
    		c: function create() {
    			div8 = element("div");
    			div3 = element("div");
    			span = element("span");
    			span.textContent = "Email";
    			t1 = space();
    			div2 = element("div");
    			div0 = element("div");
    			i0 = element("i");
    			t2 = space();
    			div1 = element("div");
    			i1 = element("i");
    			t3 = space();
    			div5 = element("div");
    			label0 = element("label");
    			label0.textContent = "Название поля";
    			t5 = space();
    			div4 = element("div");
    			input0 = element("input");
    			t6 = space();
    			div7 = element("div");
    			label1 = element("label");
    			label1.textContent = "Input name";
    			t8 = space();
    			div6 = element("div");
    			input1 = element("input");
    			t9 = space();
    			input2 = element("input");
    			attr_dev(span, "class", "badge svelte-paikox");
    			add_location(span, file$5, 13, 8, 303);
    			attr_dev(i0, "class", "is-isolated fa fa-edit");
    			add_location(i0, file$5, 16, 16, 466);
    			attr_dev(div0, "class", "btn is-isolated");
    			add_location(div0, file$5, 15, 12, 395);
    			attr_dev(i1, "class", "is-isolated fa fa-trash");
    			add_location(i1, file$5, 19, 16, 611);
    			attr_dev(div1, "class", "btn is-isolated");
    			add_location(div1, file$5, 18, 12, 538);
    			attr_dev(div2, "class", "toolbar-header-buttons");
    			add_location(div2, file$5, 14, 8, 345);
    			attr_dev(div3, "class", "toolbar-header svelte-paikox");
    			add_location(div3, file$5, 12, 4, 265);
    			attr_dev(label0, "for", "field-title");
    			attr_dev(label0, "class", "col-sm-2 control-label svelte-paikox");
    			add_location(label0, file$5, 24, 8, 738);
    			attr_dev(input0, "id", "field-title");
    			attr_dev(input0, "type", "text");
    			attr_dev(input0, "class", "form-control");
    			attr_dev(input0, "name", input0_name_value = "fields[" + /*index*/ ctx[0] + "][name]");
    			add_location(input0, file$5, 26, 12, 875);
    			attr_dev(div4, "class", "col-sm-8 control-input svelte-paikox");
    			add_location(div4, file$5, 25, 8, 825);
    			attr_dev(div5, "class", "form-group");
    			add_location(div5, file$5, 23, 4, 704);
    			attr_dev(label1, "for", "input-name");
    			attr_dev(label1, "class", "col-sm-2 control-label svelte-paikox");
    			add_location(label1, file$5, 30, 8, 1030);
    			attr_dev(input1, "id", "input-name");
    			attr_dev(input1, "type", "text");
    			attr_dev(input1, "class", "form-control");
    			attr_dev(input1, "name", input1_name_value = "fields[" + /*index*/ ctx[0] + "][name_in_form]");
    			add_location(input1, file$5, 32, 12, 1163);
    			attr_dev(div6, "class", "col-sm-8 control-input svelte-paikox");
    			add_location(div6, file$5, 31, 8, 1113);
    			attr_dev(div7, "class", "form-group");
    			add_location(div7, file$5, 29, 4, 996);
    			input2.hidden = true;
    			attr_dev(input2, "type", "checkbox");
    			attr_dev(input2, "name", input2_name_value = "fields[" + /*index*/ ctx[0] + "][is_required]");
    			input2.checked = input2_checked_value = /*settings*/ ctx[3]['isRequired'];
    			add_location(input2, file$5, 35, 4, 1291);
    			attr_dev(div8, "class", "sortable-item svelte-paikox");
    			add_location(div8, file$5, 11, 0, 232);
    		},
    		l: function claim(nodes) {
    			throw new Error("options.hydrate only works if the component was compiled with the `hydratable: true` option");
    		},
    		m: function mount(target, anchor) {
    			insert_dev(target, div8, anchor);
    			append_dev(div8, div3);
    			append_dev(div3, span);
    			append_dev(div3, t1);
    			append_dev(div3, div2);
    			append_dev(div2, div0);
    			append_dev(div0, i0);
    			append_dev(div2, t2);
    			append_dev(div2, div1);
    			append_dev(div1, i1);
    			append_dev(div8, t3);
    			append_dev(div8, div5);
    			append_dev(div5, label0);
    			append_dev(div5, t5);
    			append_dev(div5, div4);
    			append_dev(div4, input0);
    			append_dev(div8, t6);
    			append_dev(div8, div7);
    			append_dev(div7, label1);
    			append_dev(div7, t8);
    			append_dev(div7, div6);
    			append_dev(div6, input1);
    			append_dev(div8, t9);
    			append_dev(div8, input2);

    			if (!mounted) {
    				dispose = [
    					listen_dev(
    						div0,
    						"click",
    						function () {
    							if (is_function(/*showEditForm*/ ctx[2])) /*showEditForm*/ ctx[2].apply(this, arguments);
    						},
    						false,
    						false,
    						false
    					),
    					listen_dev(
    						div1,
    						"click",
    						function () {
    							if (is_function(/*removeFormItem*/ ctx[1])) /*removeFormItem*/ ctx[1].apply(this, arguments);
    						},
    						false,
    						false,
    						false
    					)
    				];

    				mounted = true;
    			}
    		},
    		p: function update(new_ctx, [dirty]) {
    			ctx = new_ctx;

    			if (dirty & /*index*/ 1 && input0_name_value !== (input0_name_value = "fields[" + /*index*/ ctx[0] + "][name]")) {
    				attr_dev(input0, "name", input0_name_value);
    			}

    			if (dirty & /*index*/ 1 && input1_name_value !== (input1_name_value = "fields[" + /*index*/ ctx[0] + "][name_in_form]")) {
    				attr_dev(input1, "name", input1_name_value);
    			}

    			if (dirty & /*index*/ 1 && input2_name_value !== (input2_name_value = "fields[" + /*index*/ ctx[0] + "][is_required]")) {
    				attr_dev(input2, "name", input2_name_value);
    			}

    			if (dirty & /*settings*/ 8 && input2_checked_value !== (input2_checked_value = /*settings*/ ctx[3]['isRequired'])) {
    				prop_dev(input2, "checked", input2_checked_value);
    			}
    		},
    		i: noop,
    		o: noop,
    		d: function destroy(detaching) {
    			if (detaching) detach_dev(div8);
    			mounted = false;
    			run_all(dispose);
    		}
    	};

    	dispatch_dev("SvelteRegisterBlock", {
    		block,
    		id: create_fragment$5.name,
    		type: "component",
    		source: "",
    		ctx
    	});

    	return block;
    }

    function getTitle$3() {
    	return "Email";
    }

    function instance$5($$self, $$props, $$invalidate) {
    	let { $$slots: slots = {}, $$scope } = $$props;
    	validate_slots('EmailItem', slots, []);
    	let { index = 0 } = $$props;
    	let { removeFormItem = () => '' } = $$props;
    	let { showEditForm = () => '' } = $$props;
    	let { settings = [] } = $$props;
    	const writable_props = ['index', 'removeFormItem', 'showEditForm', 'settings'];

    	Object.keys($$props).forEach(key => {
    		if (!~writable_props.indexOf(key) && key.slice(0, 2) !== '$$' && key !== 'slot') console.warn(`<EmailItem> was created with unknown prop '${key}'`);
    	});

    	$$self.$$set = $$props => {
    		if ('index' in $$props) $$invalidate(0, index = $$props.index);
    		if ('removeFormItem' in $$props) $$invalidate(1, removeFormItem = $$props.removeFormItem);
    		if ('showEditForm' in $$props) $$invalidate(2, showEditForm = $$props.showEditForm);
    		if ('settings' in $$props) $$invalidate(3, settings = $$props.settings);
    	};

    	$$self.$capture_state = () => ({
    		index,
    		removeFormItem,
    		showEditForm,
    		settings,
    		getTitle: getTitle$3
    	});

    	$$self.$inject_state = $$props => {
    		if ('index' in $$props) $$invalidate(0, index = $$props.index);
    		if ('removeFormItem' in $$props) $$invalidate(1, removeFormItem = $$props.removeFormItem);
    		if ('showEditForm' in $$props) $$invalidate(2, showEditForm = $$props.showEditForm);
    		if ('settings' in $$props) $$invalidate(3, settings = $$props.settings);
    	};

    	if ($$props && "$$inject" in $$props) {
    		$$self.$inject_state($$props.$$inject);
    	}

    	return [index, removeFormItem, showEditForm, settings, getTitle$3];
    }

    class EmailItem extends SvelteComponentDev {
    	constructor(options) {
    		super(options);

    		init(this, options, instance$5, create_fragment$5, safe_not_equal, {
    			index: 0,
    			removeFormItem: 1,
    			showEditForm: 2,
    			settings: 3,
    			getTitle: 4
    		});

    		dispatch_dev("SvelteRegisterComponent", {
    			component: this,
    			tagName: "EmailItem",
    			options,
    			id: create_fragment$5.name
    		});
    	}

    	get index() {
    		throw new Error("<EmailItem>: Props cannot be read directly from the component instance unless compiling with 'accessors: true' or '<svelte:options accessors/>'");
    	}

    	set index(value) {
    		throw new Error("<EmailItem>: Props cannot be set directly on the component instance unless compiling with 'accessors: true' or '<svelte:options accessors/>'");
    	}

    	get removeFormItem() {
    		throw new Error("<EmailItem>: Props cannot be read directly from the component instance unless compiling with 'accessors: true' or '<svelte:options accessors/>'");
    	}

    	set removeFormItem(value) {
    		throw new Error("<EmailItem>: Props cannot be set directly on the component instance unless compiling with 'accessors: true' or '<svelte:options accessors/>'");
    	}

    	get showEditForm() {
    		throw new Error("<EmailItem>: Props cannot be read directly from the component instance unless compiling with 'accessors: true' or '<svelte:options accessors/>'");
    	}

    	set showEditForm(value) {
    		throw new Error("<EmailItem>: Props cannot be set directly on the component instance unless compiling with 'accessors: true' or '<svelte:options accessors/>'");
    	}

    	get settings() {
    		throw new Error("<EmailItem>: Props cannot be read directly from the component instance unless compiling with 'accessors: true' or '<svelte:options accessors/>'");
    	}

    	set settings(value) {
    		throw new Error("<EmailItem>: Props cannot be set directly on the component instance unless compiling with 'accessors: true' or '<svelte:options accessors/>'");
    	}

    	get getTitle() {
    		return getTitle$3;
    	}

    	set getTitle(value) {
    		throw new Error("<EmailItem>: Props cannot be set directly on the component instance unless compiling with 'accessors: true' or '<svelte:options accessors/>'");
    	}
    }

    /* src\formItems\TextareaItem.svelte generated by Svelte v3.54.0 */

    const file$4 = "src\\formItems\\TextareaItem.svelte";

    function create_fragment$4(ctx) {
    	let div9;
    	let div8;
    	let div3;
    	let span;
    	let t1;
    	let div2;
    	let div0;
    	let i0;
    	let t2;
    	let div1;
    	let i1;
    	let t3;
    	let div5;
    	let label0;
    	let t5;
    	let div4;
    	let input0;
    	let input0_name_value;
    	let t6;
    	let div7;
    	let label1;
    	let t8;
    	let div6;
    	let input1;
    	let input1_name_value;
    	let t9;
    	let input2;
    	let input2_name_value;
    	let input2_checked_value;
    	let mounted;
    	let dispose;

    	const block = {
    		c: function create() {
    			div9 = element("div");
    			div8 = element("div");
    			div3 = element("div");
    			span = element("span");
    			span.textContent = "Textarea";
    			t1 = space();
    			div2 = element("div");
    			div0 = element("div");
    			i0 = element("i");
    			t2 = space();
    			div1 = element("div");
    			i1 = element("i");
    			t3 = space();
    			div5 = element("div");
    			label0 = element("label");
    			label0.textContent = "Название поля";
    			t5 = space();
    			div4 = element("div");
    			input0 = element("input");
    			t6 = space();
    			div7 = element("div");
    			label1 = element("label");
    			label1.textContent = "Input name";
    			t8 = space();
    			div6 = element("div");
    			input1 = element("input");
    			t9 = space();
    			input2 = element("input");
    			attr_dev(span, "class", "badge svelte-1p41suj");
    			add_location(span, file$4, 14, 12, 325);
    			attr_dev(i0, "class", "is-isolated fa fa-edit");
    			add_location(i0, file$4, 17, 20, 479);
    			attr_dev(div0, "class", "btn is-isolated");
    			add_location(div0, file$4, 16, 16, 428);
    			attr_dev(i1, "class", "is-isolated fa fa-trash");
    			add_location(i1, file$4, 20, 20, 660);
    			attr_dev(div1, "class", "btn is-isolated");
    			add_location(div1, file$4, 19, 16, 583);
    			attr_dev(div2, "class", "toolbar-header-buttons");
    			add_location(div2, file$4, 15, 12, 374);
    			attr_dev(div3, "class", "toolbar-header svelte-1p41suj");
    			add_location(div3, file$4, 13, 8, 283);
    			attr_dev(label0, "for", "field-title");
    			attr_dev(label0, "class", "col-sm-2 control-label svelte-1p41suj");
    			add_location(label0, file$4, 25, 12, 807);
    			attr_dev(input0, "id", "field-title");
    			attr_dev(input0, "type", "text");
    			attr_dev(input0, "class", "form-control");
    			attr_dev(input0, "name", input0_name_value = "fields[" + /*index*/ ctx[0] + "][name]");
    			add_location(input0, file$4, 27, 16, 952);
    			attr_dev(div4, "class", "col-sm-8 control-input svelte-1p41suj");
    			add_location(div4, file$4, 26, 12, 898);
    			attr_dev(div5, "class", "form-group");
    			add_location(div5, file$4, 24, 8, 769);
    			attr_dev(label1, "for", "input-name");
    			attr_dev(label1, "class", "col-sm-2 control-label svelte-1p41suj");
    			add_location(label1, file$4, 31, 12, 1123);
    			attr_dev(input1, "id", "input-name");
    			attr_dev(input1, "type", "text");
    			attr_dev(input1, "class", "form-control");
    			attr_dev(input1, "name", input1_name_value = "fields[" + /*index*/ ctx[0] + "][name_in_form]");
    			add_location(input1, file$4, 33, 16, 1264);
    			attr_dev(div6, "class", "col-sm-8 control-input svelte-1p41suj");
    			add_location(div6, file$4, 32, 12, 1210);
    			attr_dev(div7, "class", "form-group");
    			add_location(div7, file$4, 30, 8, 1085);
    			input2.hidden = true;
    			attr_dev(input2, "type", "checkbox");
    			attr_dev(input2, "name", input2_name_value = "fields[" + /*index*/ ctx[0] + "][is_required]");
    			input2.checked = input2_checked_value = /*settings*/ ctx[3]['isRequired'];
    			add_location(input2, file$4, 36, 8, 1404);
    			attr_dev(div8, "class", "sortable-item svelte-1p41suj");
    			add_location(div8, file$4, 12, 4, 246);
    			add_location(div9, file$4, 11, 0, 235);
    		},
    		l: function claim(nodes) {
    			throw new Error("options.hydrate only works if the component was compiled with the `hydratable: true` option");
    		},
    		m: function mount(target, anchor) {
    			insert_dev(target, div9, anchor);
    			append_dev(div9, div8);
    			append_dev(div8, div3);
    			append_dev(div3, span);
    			append_dev(div3, t1);
    			append_dev(div3, div2);
    			append_dev(div2, div0);
    			append_dev(div0, i0);
    			append_dev(div2, t2);
    			append_dev(div2, div1);
    			append_dev(div1, i1);
    			append_dev(div8, t3);
    			append_dev(div8, div5);
    			append_dev(div5, label0);
    			append_dev(div5, t5);
    			append_dev(div5, div4);
    			append_dev(div4, input0);
    			append_dev(div8, t6);
    			append_dev(div8, div7);
    			append_dev(div7, label1);
    			append_dev(div7, t8);
    			append_dev(div7, div6);
    			append_dev(div6, input1);
    			append_dev(div8, t9);
    			append_dev(div8, input2);

    			if (!mounted) {
    				dispose = [
    					listen_dev(
    						i0,
    						"click",
    						function () {
    							if (is_function(/*showEditForm*/ ctx[2])) /*showEditForm*/ ctx[2].apply(this, arguments);
    						},
    						false,
    						false,
    						false
    					),
    					listen_dev(
    						div1,
    						"click",
    						function () {
    							if (is_function(/*removeFormItem*/ ctx[1])) /*removeFormItem*/ ctx[1].apply(this, arguments);
    						},
    						false,
    						false,
    						false
    					)
    				];

    				mounted = true;
    			}
    		},
    		p: function update(new_ctx, [dirty]) {
    			ctx = new_ctx;

    			if (dirty & /*index*/ 1 && input0_name_value !== (input0_name_value = "fields[" + /*index*/ ctx[0] + "][name]")) {
    				attr_dev(input0, "name", input0_name_value);
    			}

    			if (dirty & /*index*/ 1 && input1_name_value !== (input1_name_value = "fields[" + /*index*/ ctx[0] + "][name_in_form]")) {
    				attr_dev(input1, "name", input1_name_value);
    			}

    			if (dirty & /*index*/ 1 && input2_name_value !== (input2_name_value = "fields[" + /*index*/ ctx[0] + "][is_required]")) {
    				attr_dev(input2, "name", input2_name_value);
    			}

    			if (dirty & /*settings*/ 8 && input2_checked_value !== (input2_checked_value = /*settings*/ ctx[3]['isRequired'])) {
    				prop_dev(input2, "checked", input2_checked_value);
    			}
    		},
    		i: noop,
    		o: noop,
    		d: function destroy(detaching) {
    			if (detaching) detach_dev(div9);
    			mounted = false;
    			run_all(dispose);
    		}
    	};

    	dispatch_dev("SvelteRegisterBlock", {
    		block,
    		id: create_fragment$4.name,
    		type: "component",
    		source: "",
    		ctx
    	});

    	return block;
    }

    function getTitle$2() {
    	return 'Textarea';
    }

    function instance$4($$self, $$props, $$invalidate) {
    	let { $$slots: slots = {}, $$scope } = $$props;
    	validate_slots('TextareaItem', slots, []);
    	let { index = 0 } = $$props;
    	let { removeFormItem = () => '' } = $$props;
    	let { showEditForm = () => '' } = $$props;
    	let { settings = [] } = $$props;
    	const writable_props = ['index', 'removeFormItem', 'showEditForm', 'settings'];

    	Object.keys($$props).forEach(key => {
    		if (!~writable_props.indexOf(key) && key.slice(0, 2) !== '$$' && key !== 'slot') console.warn(`<TextareaItem> was created with unknown prop '${key}'`);
    	});

    	$$self.$$set = $$props => {
    		if ('index' in $$props) $$invalidate(0, index = $$props.index);
    		if ('removeFormItem' in $$props) $$invalidate(1, removeFormItem = $$props.removeFormItem);
    		if ('showEditForm' in $$props) $$invalidate(2, showEditForm = $$props.showEditForm);
    		if ('settings' in $$props) $$invalidate(3, settings = $$props.settings);
    	};

    	$$self.$capture_state = () => ({
    		index,
    		removeFormItem,
    		showEditForm,
    		settings,
    		getTitle: getTitle$2
    	});

    	$$self.$inject_state = $$props => {
    		if ('index' in $$props) $$invalidate(0, index = $$props.index);
    		if ('removeFormItem' in $$props) $$invalidate(1, removeFormItem = $$props.removeFormItem);
    		if ('showEditForm' in $$props) $$invalidate(2, showEditForm = $$props.showEditForm);
    		if ('settings' in $$props) $$invalidate(3, settings = $$props.settings);
    	};

    	if ($$props && "$$inject" in $$props) {
    		$$self.$inject_state($$props.$$inject);
    	}

    	return [index, removeFormItem, showEditForm, settings, getTitle$2];
    }

    class TextareaItem extends SvelteComponentDev {
    	constructor(options) {
    		super(options);

    		init(this, options, instance$4, create_fragment$4, safe_not_equal, {
    			index: 0,
    			removeFormItem: 1,
    			showEditForm: 2,
    			settings: 3,
    			getTitle: 4
    		});

    		dispatch_dev("SvelteRegisterComponent", {
    			component: this,
    			tagName: "TextareaItem",
    			options,
    			id: create_fragment$4.name
    		});
    	}

    	get index() {
    		throw new Error("<TextareaItem>: Props cannot be read directly from the component instance unless compiling with 'accessors: true' or '<svelte:options accessors/>'");
    	}

    	set index(value) {
    		throw new Error("<TextareaItem>: Props cannot be set directly on the component instance unless compiling with 'accessors: true' or '<svelte:options accessors/>'");
    	}

    	get removeFormItem() {
    		throw new Error("<TextareaItem>: Props cannot be read directly from the component instance unless compiling with 'accessors: true' or '<svelte:options accessors/>'");
    	}

    	set removeFormItem(value) {
    		throw new Error("<TextareaItem>: Props cannot be set directly on the component instance unless compiling with 'accessors: true' or '<svelte:options accessors/>'");
    	}

    	get showEditForm() {
    		throw new Error("<TextareaItem>: Props cannot be read directly from the component instance unless compiling with 'accessors: true' or '<svelte:options accessors/>'");
    	}

    	set showEditForm(value) {
    		throw new Error("<TextareaItem>: Props cannot be set directly on the component instance unless compiling with 'accessors: true' or '<svelte:options accessors/>'");
    	}

    	get settings() {
    		throw new Error("<TextareaItem>: Props cannot be read directly from the component instance unless compiling with 'accessors: true' or '<svelte:options accessors/>'");
    	}

    	set settings(value) {
    		throw new Error("<TextareaItem>: Props cannot be set directly on the component instance unless compiling with 'accessors: true' or '<svelte:options accessors/>'");
    	}

    	get getTitle() {
    		return getTitle$2;
    	}

    	set getTitle(value) {
    		throw new Error("<TextareaItem>: Props cannot be set directly on the component instance unless compiling with 'accessors: true' or '<svelte:options accessors/>'");
    	}
    }

    /* src\formItems\CheckboxItem.svelte generated by Svelte v3.54.0 */

    const file$3 = "src\\formItems\\CheckboxItem.svelte";

    function create_fragment$3(ctx) {
    	let div9;
    	let div8;
    	let div3;
    	let span;
    	let t1;
    	let div2;
    	let div0;
    	let i0;
    	let t2;
    	let div1;
    	let i1;
    	let t3;
    	let div5;
    	let label0;
    	let t5;
    	let div4;
    	let input0;
    	let input0_name_value;
    	let t6;
    	let div7;
    	let label1;
    	let t8;
    	let div6;
    	let input1;
    	let input1_name_value;
    	let t9;
    	let input2;
    	let input2_name_value;
    	let input2_checked_value;
    	let mounted;
    	let dispose;

    	const block = {
    		c: function create() {
    			div9 = element("div");
    			div8 = element("div");
    			div3 = element("div");
    			span = element("span");
    			span.textContent = "Сheckbox";
    			t1 = space();
    			div2 = element("div");
    			div0 = element("div");
    			i0 = element("i");
    			t2 = space();
    			div1 = element("div");
    			i1 = element("i");
    			t3 = space();
    			div5 = element("div");
    			label0 = element("label");
    			label0.textContent = "Название поля";
    			t5 = space();
    			div4 = element("div");
    			input0 = element("input");
    			t6 = space();
    			div7 = element("div");
    			label1 = element("label");
    			label1.textContent = "Input name";
    			t8 = space();
    			div6 = element("div");
    			input1 = element("input");
    			t9 = space();
    			input2 = element("input");
    			attr_dev(span, "class", "badge svelte-1p41suj");
    			add_location(span, file$3, 14, 12, 325);
    			attr_dev(i0, "class", "is-isolated fa fa-edit");
    			add_location(i0, file$3, 17, 20, 503);
    			attr_dev(div0, "class", "btn is-isolated");
    			add_location(div0, file$3, 16, 16, 428);
    			attr_dev(i1, "class", "is-isolated fa fa-trash");
    			add_location(i1, file$3, 20, 20, 660);
    			attr_dev(div1, "class", "btn is-isolated");
    			add_location(div1, file$3, 19, 16, 583);
    			attr_dev(div2, "class", "toolbar-header-buttons");
    			add_location(div2, file$3, 15, 12, 374);
    			attr_dev(div3, "class", "toolbar-header svelte-1p41suj");
    			add_location(div3, file$3, 13, 8, 283);
    			attr_dev(label0, "for", "field-title");
    			attr_dev(label0, "class", "col-sm-2 control-label svelte-1p41suj");
    			add_location(label0, file$3, 25, 12, 807);
    			attr_dev(input0, "id", "field-title");
    			attr_dev(input0, "type", "text");
    			attr_dev(input0, "class", "form-control");
    			attr_dev(input0, "name", input0_name_value = "fields[" + /*index*/ ctx[0] + "][name]");
    			add_location(input0, file$3, 27, 16, 952);
    			attr_dev(div4, "class", "col-sm-8 control-input svelte-1p41suj");
    			add_location(div4, file$3, 26, 12, 898);
    			attr_dev(div5, "class", "form-group");
    			add_location(div5, file$3, 24, 8, 769);
    			attr_dev(label1, "for", "input-name");
    			attr_dev(label1, "class", "col-sm-2 control-label svelte-1p41suj");
    			add_location(label1, file$3, 31, 12, 1123);
    			attr_dev(input1, "id", "input-name");
    			attr_dev(input1, "type", "text");
    			attr_dev(input1, "class", "form-control");
    			attr_dev(input1, "name", input1_name_value = "fields[" + /*index*/ ctx[0] + "][name_in_form]");
    			add_location(input1, file$3, 33, 16, 1264);
    			attr_dev(div6, "class", "col-sm-8 control-input svelte-1p41suj");
    			add_location(div6, file$3, 32, 12, 1210);
    			attr_dev(div7, "class", "form-group");
    			add_location(div7, file$3, 30, 8, 1085);
    			input2.hidden = true;
    			attr_dev(input2, "type", "checkbox");
    			attr_dev(input2, "name", input2_name_value = "fields[" + /*index*/ ctx[0] + "][is_required]");
    			input2.checked = input2_checked_value = /*settings*/ ctx[3]['isRequired'];
    			add_location(input2, file$3, 36, 8, 1404);
    			attr_dev(div8, "class", "sortable-item svelte-1p41suj");
    			add_location(div8, file$3, 12, 4, 246);
    			add_location(div9, file$3, 11, 0, 235);
    		},
    		l: function claim(nodes) {
    			throw new Error("options.hydrate only works if the component was compiled with the `hydratable: true` option");
    		},
    		m: function mount(target, anchor) {
    			insert_dev(target, div9, anchor);
    			append_dev(div9, div8);
    			append_dev(div8, div3);
    			append_dev(div3, span);
    			append_dev(div3, t1);
    			append_dev(div3, div2);
    			append_dev(div2, div0);
    			append_dev(div0, i0);
    			append_dev(div2, t2);
    			append_dev(div2, div1);
    			append_dev(div1, i1);
    			append_dev(div8, t3);
    			append_dev(div8, div5);
    			append_dev(div5, label0);
    			append_dev(div5, t5);
    			append_dev(div5, div4);
    			append_dev(div4, input0);
    			append_dev(div8, t6);
    			append_dev(div8, div7);
    			append_dev(div7, label1);
    			append_dev(div7, t8);
    			append_dev(div7, div6);
    			append_dev(div6, input1);
    			append_dev(div8, t9);
    			append_dev(div8, input2);

    			if (!mounted) {
    				dispose = [
    					listen_dev(
    						div0,
    						"click",
    						function () {
    							if (is_function(/*showEditForm*/ ctx[2])) /*showEditForm*/ ctx[2].apply(this, arguments);
    						},
    						false,
    						false,
    						false
    					),
    					listen_dev(
    						div1,
    						"click",
    						function () {
    							if (is_function(/*removeFormItem*/ ctx[1])) /*removeFormItem*/ ctx[1].apply(this, arguments);
    						},
    						false,
    						false,
    						false
    					)
    				];

    				mounted = true;
    			}
    		},
    		p: function update(new_ctx, [dirty]) {
    			ctx = new_ctx;

    			if (dirty & /*index*/ 1 && input0_name_value !== (input0_name_value = "fields[" + /*index*/ ctx[0] + "][name]")) {
    				attr_dev(input0, "name", input0_name_value);
    			}

    			if (dirty & /*index*/ 1 && input1_name_value !== (input1_name_value = "fields[" + /*index*/ ctx[0] + "][name_in_form]")) {
    				attr_dev(input1, "name", input1_name_value);
    			}

    			if (dirty & /*index*/ 1 && input2_name_value !== (input2_name_value = "fields[" + /*index*/ ctx[0] + "][is_required]")) {
    				attr_dev(input2, "name", input2_name_value);
    			}

    			if (dirty & /*settings*/ 8 && input2_checked_value !== (input2_checked_value = /*settings*/ ctx[3]['isRequired'])) {
    				prop_dev(input2, "checked", input2_checked_value);
    			}
    		},
    		i: noop,
    		o: noop,
    		d: function destroy(detaching) {
    			if (detaching) detach_dev(div9);
    			mounted = false;
    			run_all(dispose);
    		}
    	};

    	dispatch_dev("SvelteRegisterBlock", {
    		block,
    		id: create_fragment$3.name,
    		type: "component",
    		source: "",
    		ctx
    	});

    	return block;
    }

    function getTitle$1() {
    	return 'Сheckbox';
    }

    function instance$3($$self, $$props, $$invalidate) {
    	let { $$slots: slots = {}, $$scope } = $$props;
    	validate_slots('CheckboxItem', slots, []);
    	let { index = 0 } = $$props;
    	let { removeFormItem = () => '' } = $$props;
    	let { showEditForm = () => '' } = $$props;
    	let { settings = [] } = $$props;
    	const writable_props = ['index', 'removeFormItem', 'showEditForm', 'settings'];

    	Object.keys($$props).forEach(key => {
    		if (!~writable_props.indexOf(key) && key.slice(0, 2) !== '$$' && key !== 'slot') console.warn(`<CheckboxItem> was created with unknown prop '${key}'`);
    	});

    	$$self.$$set = $$props => {
    		if ('index' in $$props) $$invalidate(0, index = $$props.index);
    		if ('removeFormItem' in $$props) $$invalidate(1, removeFormItem = $$props.removeFormItem);
    		if ('showEditForm' in $$props) $$invalidate(2, showEditForm = $$props.showEditForm);
    		if ('settings' in $$props) $$invalidate(3, settings = $$props.settings);
    	};

    	$$self.$capture_state = () => ({
    		index,
    		removeFormItem,
    		showEditForm,
    		settings,
    		getTitle: getTitle$1
    	});

    	$$self.$inject_state = $$props => {
    		if ('index' in $$props) $$invalidate(0, index = $$props.index);
    		if ('removeFormItem' in $$props) $$invalidate(1, removeFormItem = $$props.removeFormItem);
    		if ('showEditForm' in $$props) $$invalidate(2, showEditForm = $$props.showEditForm);
    		if ('settings' in $$props) $$invalidate(3, settings = $$props.settings);
    	};

    	if ($$props && "$$inject" in $$props) {
    		$$self.$inject_state($$props.$$inject);
    	}

    	return [index, removeFormItem, showEditForm, settings, getTitle$1];
    }

    class CheckboxItem extends SvelteComponentDev {
    	constructor(options) {
    		super(options);

    		init(this, options, instance$3, create_fragment$3, safe_not_equal, {
    			index: 0,
    			removeFormItem: 1,
    			showEditForm: 2,
    			settings: 3,
    			getTitle: 4
    		});

    		dispatch_dev("SvelteRegisterComponent", {
    			component: this,
    			tagName: "CheckboxItem",
    			options,
    			id: create_fragment$3.name
    		});
    	}

    	get index() {
    		throw new Error("<CheckboxItem>: Props cannot be read directly from the component instance unless compiling with 'accessors: true' or '<svelte:options accessors/>'");
    	}

    	set index(value) {
    		throw new Error("<CheckboxItem>: Props cannot be set directly on the component instance unless compiling with 'accessors: true' or '<svelte:options accessors/>'");
    	}

    	get removeFormItem() {
    		throw new Error("<CheckboxItem>: Props cannot be read directly from the component instance unless compiling with 'accessors: true' or '<svelte:options accessors/>'");
    	}

    	set removeFormItem(value) {
    		throw new Error("<CheckboxItem>: Props cannot be set directly on the component instance unless compiling with 'accessors: true' or '<svelte:options accessors/>'");
    	}

    	get showEditForm() {
    		throw new Error("<CheckboxItem>: Props cannot be read directly from the component instance unless compiling with 'accessors: true' or '<svelte:options accessors/>'");
    	}

    	set showEditForm(value) {
    		throw new Error("<CheckboxItem>: Props cannot be set directly on the component instance unless compiling with 'accessors: true' or '<svelte:options accessors/>'");
    	}

    	get settings() {
    		throw new Error("<CheckboxItem>: Props cannot be read directly from the component instance unless compiling with 'accessors: true' or '<svelte:options accessors/>'");
    	}

    	set settings(value) {
    		throw new Error("<CheckboxItem>: Props cannot be set directly on the component instance unless compiling with 'accessors: true' or '<svelte:options accessors/>'");
    	}

    	get getTitle() {
    		return getTitle$1;
    	}

    	set getTitle(value) {
    		throw new Error("<CheckboxItem>: Props cannot be set directly on the component instance unless compiling with 'accessors: true' or '<svelte:options accessors/>'");
    	}
    }

    /* src\formItems\RadioItem.svelte generated by Svelte v3.54.0 */

    const file$2 = "src\\formItems\\RadioItem.svelte";

    function create_fragment$2(ctx) {
    	let div9;
    	let div8;
    	let div3;
    	let span;
    	let t1;
    	let div2;
    	let div0;
    	let i0;
    	let t2;
    	let div1;
    	let i1;
    	let t3;
    	let div5;
    	let label0;
    	let t5;
    	let div4;
    	let input0;
    	let input0_name_value;
    	let t6;
    	let div7;
    	let label1;
    	let t8;
    	let div6;
    	let input1;
    	let input1_name_value;
    	let t9;
    	let input2;
    	let input2_name_value;
    	let input2_checked_value;
    	let mounted;
    	let dispose;

    	const block = {
    		c: function create() {
    			div9 = element("div");
    			div8 = element("div");
    			div3 = element("div");
    			span = element("span");
    			span.textContent = "Radio";
    			t1 = space();
    			div2 = element("div");
    			div0 = element("div");
    			i0 = element("i");
    			t2 = space();
    			div1 = element("div");
    			i1 = element("i");
    			t3 = space();
    			div5 = element("div");
    			label0 = element("label");
    			label0.textContent = "Название поля";
    			t5 = space();
    			div4 = element("div");
    			input0 = element("input");
    			t6 = space();
    			div7 = element("div");
    			label1 = element("label");
    			label1.textContent = "Input name";
    			t8 = space();
    			div6 = element("div");
    			input1 = element("input");
    			t9 = space();
    			input2 = element("input");
    			attr_dev(span, "class", "badge svelte-1p41suj");
    			add_location(span, file$2, 14, 12, 322);
    			attr_dev(i0, "class", "is-isolated fa fa-edit");
    			add_location(i0, file$2, 17, 20, 473);
    			attr_dev(div0, "class", "btn is-isolated");
    			add_location(div0, file$2, 16, 16, 422);
    			attr_dev(i1, "class", "is-isolated fa fa-trash");
    			add_location(i1, file$2, 20, 20, 654);
    			attr_dev(div1, "class", "btn is-isolated");
    			add_location(div1, file$2, 19, 16, 577);
    			attr_dev(div2, "class", "toolbar-header-buttons");
    			add_location(div2, file$2, 15, 12, 368);
    			attr_dev(div3, "class", "toolbar-header svelte-1p41suj");
    			add_location(div3, file$2, 13, 8, 280);
    			attr_dev(label0, "for", "field-title");
    			attr_dev(label0, "class", "col-sm-2 control-label svelte-1p41suj");
    			add_location(label0, file$2, 25, 12, 801);
    			attr_dev(input0, "id", "field-title");
    			attr_dev(input0, "type", "text");
    			attr_dev(input0, "class", "form-control");
    			attr_dev(input0, "name", input0_name_value = "fields[" + /*index*/ ctx[0] + "][name]");
    			add_location(input0, file$2, 27, 16, 946);
    			attr_dev(div4, "class", "col-sm-8 control-input svelte-1p41suj");
    			add_location(div4, file$2, 26, 12, 892);
    			attr_dev(div5, "class", "form-group");
    			add_location(div5, file$2, 24, 8, 763);
    			attr_dev(label1, "for", "input-name");
    			attr_dev(label1, "class", "col-sm-2 control-label svelte-1p41suj");
    			add_location(label1, file$2, 31, 12, 1117);
    			attr_dev(input1, "id", "input-name");
    			attr_dev(input1, "type", "text");
    			attr_dev(input1, "class", "form-control");
    			attr_dev(input1, "name", input1_name_value = "fields[" + /*index*/ ctx[0] + "][name_in_form]");
    			add_location(input1, file$2, 33, 16, 1258);
    			attr_dev(div6, "class", "col-sm-8 control-input svelte-1p41suj");
    			add_location(div6, file$2, 32, 12, 1204);
    			attr_dev(div7, "class", "form-group");
    			add_location(div7, file$2, 30, 8, 1079);
    			input2.hidden = true;
    			attr_dev(input2, "type", "checkbox");
    			attr_dev(input2, "name", input2_name_value = "fields[" + /*index*/ ctx[0] + "][is_required]");
    			input2.checked = input2_checked_value = /*settings*/ ctx[3]['isRequired'];
    			add_location(input2, file$2, 36, 8, 1398);
    			attr_dev(div8, "class", "sortable-item svelte-1p41suj");
    			add_location(div8, file$2, 12, 4, 243);
    			add_location(div9, file$2, 11, 0, 232);
    		},
    		l: function claim(nodes) {
    			throw new Error("options.hydrate only works if the component was compiled with the `hydratable: true` option");
    		},
    		m: function mount(target, anchor) {
    			insert_dev(target, div9, anchor);
    			append_dev(div9, div8);
    			append_dev(div8, div3);
    			append_dev(div3, span);
    			append_dev(div3, t1);
    			append_dev(div3, div2);
    			append_dev(div2, div0);
    			append_dev(div0, i0);
    			append_dev(div2, t2);
    			append_dev(div2, div1);
    			append_dev(div1, i1);
    			append_dev(div8, t3);
    			append_dev(div8, div5);
    			append_dev(div5, label0);
    			append_dev(div5, t5);
    			append_dev(div5, div4);
    			append_dev(div4, input0);
    			append_dev(div8, t6);
    			append_dev(div8, div7);
    			append_dev(div7, label1);
    			append_dev(div7, t8);
    			append_dev(div7, div6);
    			append_dev(div6, input1);
    			append_dev(div8, t9);
    			append_dev(div8, input2);

    			if (!mounted) {
    				dispose = [
    					listen_dev(
    						i0,
    						"click",
    						function () {
    							if (is_function(/*showEditForm*/ ctx[2])) /*showEditForm*/ ctx[2].apply(this, arguments);
    						},
    						false,
    						false,
    						false
    					),
    					listen_dev(
    						div1,
    						"click",
    						function () {
    							if (is_function(/*removeFormItem*/ ctx[1])) /*removeFormItem*/ ctx[1].apply(this, arguments);
    						},
    						false,
    						false,
    						false
    					)
    				];

    				mounted = true;
    			}
    		},
    		p: function update(new_ctx, [dirty]) {
    			ctx = new_ctx;

    			if (dirty & /*index*/ 1 && input0_name_value !== (input0_name_value = "fields[" + /*index*/ ctx[0] + "][name]")) {
    				attr_dev(input0, "name", input0_name_value);
    			}

    			if (dirty & /*index*/ 1 && input1_name_value !== (input1_name_value = "fields[" + /*index*/ ctx[0] + "][name_in_form]")) {
    				attr_dev(input1, "name", input1_name_value);
    			}

    			if (dirty & /*index*/ 1 && input2_name_value !== (input2_name_value = "fields[" + /*index*/ ctx[0] + "][is_required]")) {
    				attr_dev(input2, "name", input2_name_value);
    			}

    			if (dirty & /*settings*/ 8 && input2_checked_value !== (input2_checked_value = /*settings*/ ctx[3]['isRequired'])) {
    				prop_dev(input2, "checked", input2_checked_value);
    			}
    		},
    		i: noop,
    		o: noop,
    		d: function destroy(detaching) {
    			if (detaching) detach_dev(div9);
    			mounted = false;
    			run_all(dispose);
    		}
    	};

    	dispatch_dev("SvelteRegisterBlock", {
    		block,
    		id: create_fragment$2.name,
    		type: "component",
    		source: "",
    		ctx
    	});

    	return block;
    }

    function getTitle() {
    	return 'Radio';
    }

    function instance$2($$self, $$props, $$invalidate) {
    	let { $$slots: slots = {}, $$scope } = $$props;
    	validate_slots('RadioItem', slots, []);
    	let { index = 0 } = $$props;
    	let { removeFormItem = () => '' } = $$props;
    	let { showEditForm = () => '' } = $$props;
    	let { settings = [] } = $$props;
    	const writable_props = ['index', 'removeFormItem', 'showEditForm', 'settings'];

    	Object.keys($$props).forEach(key => {
    		if (!~writable_props.indexOf(key) && key.slice(0, 2) !== '$$' && key !== 'slot') console.warn(`<RadioItem> was created with unknown prop '${key}'`);
    	});

    	$$self.$$set = $$props => {
    		if ('index' in $$props) $$invalidate(0, index = $$props.index);
    		if ('removeFormItem' in $$props) $$invalidate(1, removeFormItem = $$props.removeFormItem);
    		if ('showEditForm' in $$props) $$invalidate(2, showEditForm = $$props.showEditForm);
    		if ('settings' in $$props) $$invalidate(3, settings = $$props.settings);
    	};

    	$$self.$capture_state = () => ({
    		index,
    		removeFormItem,
    		showEditForm,
    		settings,
    		getTitle
    	});

    	$$self.$inject_state = $$props => {
    		if ('index' in $$props) $$invalidate(0, index = $$props.index);
    		if ('removeFormItem' in $$props) $$invalidate(1, removeFormItem = $$props.removeFormItem);
    		if ('showEditForm' in $$props) $$invalidate(2, showEditForm = $$props.showEditForm);
    		if ('settings' in $$props) $$invalidate(3, settings = $$props.settings);
    	};

    	if ($$props && "$$inject" in $$props) {
    		$$self.$inject_state($$props.$$inject);
    	}

    	return [index, removeFormItem, showEditForm, settings, getTitle];
    }

    class RadioItem extends SvelteComponentDev {
    	constructor(options) {
    		super(options);

    		init(this, options, instance$2, create_fragment$2, safe_not_equal, {
    			index: 0,
    			removeFormItem: 1,
    			showEditForm: 2,
    			settings: 3,
    			getTitle: 4
    		});

    		dispatch_dev("SvelteRegisterComponent", {
    			component: this,
    			tagName: "RadioItem",
    			options,
    			id: create_fragment$2.name
    		});
    	}

    	get index() {
    		throw new Error("<RadioItem>: Props cannot be read directly from the component instance unless compiling with 'accessors: true' or '<svelte:options accessors/>'");
    	}

    	set index(value) {
    		throw new Error("<RadioItem>: Props cannot be set directly on the component instance unless compiling with 'accessors: true' or '<svelte:options accessors/>'");
    	}

    	get removeFormItem() {
    		throw new Error("<RadioItem>: Props cannot be read directly from the component instance unless compiling with 'accessors: true' or '<svelte:options accessors/>'");
    	}

    	set removeFormItem(value) {
    		throw new Error("<RadioItem>: Props cannot be set directly on the component instance unless compiling with 'accessors: true' or '<svelte:options accessors/>'");
    	}

    	get showEditForm() {
    		throw new Error("<RadioItem>: Props cannot be read directly from the component instance unless compiling with 'accessors: true' or '<svelte:options accessors/>'");
    	}

    	set showEditForm(value) {
    		throw new Error("<RadioItem>: Props cannot be set directly on the component instance unless compiling with 'accessors: true' or '<svelte:options accessors/>'");
    	}

    	get settings() {
    		throw new Error("<RadioItem>: Props cannot be read directly from the component instance unless compiling with 'accessors: true' or '<svelte:options accessors/>'");
    	}

    	set settings(value) {
    		throw new Error("<RadioItem>: Props cannot be set directly on the component instance unless compiling with 'accessors: true' or '<svelte:options accessors/>'");
    	}

    	get getTitle() {
    		return getTitle;
    	}

    	set getTitle(value) {
    		throw new Error("<RadioItem>: Props cannot be set directly on the component instance unless compiling with 'accessors: true' or '<svelte:options accessors/>'");
    	}
    }

    /* src\EditForm.svelte generated by Svelte v3.54.0 */

    const file$1 = "src\\EditForm.svelte";

    function create_fragment$1(ctx) {
    	let div2;
    	let div0;
    	let t1;
    	let h2;
    	let t2;
    	let t3;
    	let div1;
    	let input;
    	let t4;
    	let label;
    	let mounted;
    	let dispose;

    	const block = {
    		c: function create() {
    			div2 = element("div");
    			div0 = element("div");
    			div0.textContent = "х";
    			t1 = space();
    			h2 = element("h2");
    			t2 = text(/*itemTitle*/ ctx[1]);
    			t3 = space();
    			div1 = element("div");
    			input = element("input");
    			t4 = space();
    			label = element("label");
    			label.textContent = "Required";
    			attr_dev(div0, "class", "closePanelWindow svelte-1hj51cq");
    			add_location(div0, file$1, 7, 4, 165);
    			set_style(h2, "font-size", "18px");
    			set_style(h2, "margin-bottom", "0");
    			attr_dev(h2, "class", "svelte-1hj51cq");
    			add_location(h2, file$1, 8, 4, 235);
    			attr_dev(input, "id", "is-requred");
    			attr_dev(input, "class", "custom-control-input svelte-1hj51cq");
    			attr_dev(input, "type", "checkbox");
    			add_location(input, file$1, 11, 8, 360);
    			attr_dev(label, "class", "custom-control-label svelte-1hj51cq");
    			attr_dev(label, "for", "is-requred");
    			add_location(label, file$1, 12, 8, 464);
    			attr_dev(div1, "class", "custom-control custom-checkbox svelte-1hj51cq");
    			add_location(div1, file$1, 10, 4, 306);
    			attr_dev(div2, "class", "contentPanel svelte-1hj51cq");
    			add_location(div2, file$1, 6, 0, 133);
    		},
    		l: function claim(nodes) {
    			throw new Error("options.hydrate only works if the component was compiled with the `hydratable: true` option");
    		},
    		m: function mount(target, anchor) {
    			insert_dev(target, div2, anchor);
    			append_dev(div2, div0);
    			append_dev(div2, t1);
    			append_dev(div2, h2);
    			append_dev(h2, t2);
    			append_dev(div2, t3);
    			append_dev(div2, div1);
    			append_dev(div1, input);
    			input.checked = /*isRequired*/ ctx[0];
    			append_dev(div1, t4);
    			append_dev(div1, label);

    			if (!mounted) {
    				dispose = [
    					listen_dev(
    						div0,
    						"click",
    						function () {
    							if (is_function(/*closeEditForm*/ ctx[2]())) /*closeEditForm*/ ctx[2]().apply(this, arguments);
    						},
    						false,
    						false,
    						false
    					),
    					listen_dev(input, "change", /*input_change_handler*/ ctx[3])
    				];

    				mounted = true;
    			}
    		},
    		p: function update(new_ctx, [dirty]) {
    			ctx = new_ctx;
    			if (dirty & /*itemTitle*/ 2) set_data_dev(t2, /*itemTitle*/ ctx[1]);

    			if (dirty & /*isRequired*/ 1) {
    				input.checked = /*isRequired*/ ctx[0];
    			}
    		},
    		i: noop,
    		o: noop,
    		d: function destroy(detaching) {
    			if (detaching) detach_dev(div2);
    			mounted = false;
    			run_all(dispose);
    		}
    	};

    	dispatch_dev("SvelteRegisterBlock", {
    		block,
    		id: create_fragment$1.name,
    		type: "component",
    		source: "",
    		ctx
    	});

    	return block;
    }

    function instance$1($$self, $$props, $$invalidate) {
    	let { $$slots: slots = {}, $$scope } = $$props;
    	validate_slots('EditForm', slots, []);
    	let { itemTitle = "" } = $$props;
    	let { closeEditForm = () => "" } = $$props;
    	let { isRequired = false } = $$props;
    	const writable_props = ['itemTitle', 'closeEditForm', 'isRequired'];

    	Object.keys($$props).forEach(key => {
    		if (!~writable_props.indexOf(key) && key.slice(0, 2) !== '$$' && key !== 'slot') console.warn(`<EditForm> was created with unknown prop '${key}'`);
    	});

    	function input_change_handler() {
    		isRequired = this.checked;
    		$$invalidate(0, isRequired);
    	}

    	$$self.$$set = $$props => {
    		if ('itemTitle' in $$props) $$invalidate(1, itemTitle = $$props.itemTitle);
    		if ('closeEditForm' in $$props) $$invalidate(2, closeEditForm = $$props.closeEditForm);
    		if ('isRequired' in $$props) $$invalidate(0, isRequired = $$props.isRequired);
    	};

    	$$self.$capture_state = () => ({ itemTitle, closeEditForm, isRequired });

    	$$self.$inject_state = $$props => {
    		if ('itemTitle' in $$props) $$invalidate(1, itemTitle = $$props.itemTitle);
    		if ('closeEditForm' in $$props) $$invalidate(2, closeEditForm = $$props.closeEditForm);
    		if ('isRequired' in $$props) $$invalidate(0, isRequired = $$props.isRequired);
    	};

    	if ($$props && "$$inject" in $$props) {
    		$$self.$inject_state($$props.$$inject);
    	}

    	return [isRequired, itemTitle, closeEditForm, input_change_handler];
    }

    class EditForm extends SvelteComponentDev {
    	constructor(options) {
    		super(options);

    		init(this, options, instance$1, create_fragment$1, safe_not_equal, {
    			itemTitle: 1,
    			closeEditForm: 2,
    			isRequired: 0
    		});

    		dispatch_dev("SvelteRegisterComponent", {
    			component: this,
    			tagName: "EditForm",
    			options,
    			id: create_fragment$1.name
    		});
    	}

    	get itemTitle() {
    		throw new Error("<EditForm>: Props cannot be read directly from the component instance unless compiling with 'accessors: true' or '<svelte:options accessors/>'");
    	}

    	set itemTitle(value) {
    		throw new Error("<EditForm>: Props cannot be set directly on the component instance unless compiling with 'accessors: true' or '<svelte:options accessors/>'");
    	}

    	get closeEditForm() {
    		throw new Error("<EditForm>: Props cannot be read directly from the component instance unless compiling with 'accessors: true' or '<svelte:options accessors/>'");
    	}

    	set closeEditForm(value) {
    		throw new Error("<EditForm>: Props cannot be set directly on the component instance unless compiling with 'accessors: true' or '<svelte:options accessors/>'");
    	}

    	get isRequired() {
    		throw new Error("<EditForm>: Props cannot be read directly from the component instance unless compiling with 'accessors: true' or '<svelte:options accessors/>'");
    	}

    	set isRequired(value) {
    		throw new Error("<EditForm>: Props cannot be set directly on the component instance unless compiling with 'accessors: true' or '<svelte:options accessors/>'");
    	}
    }

    /* src\App.svelte generated by Svelte v3.54.0 */
    const file = "src\\App.svelte";

    function get_each_context(ctx, list, i) {
    	const child_ctx = ctx.slice();
    	child_ctx[16] = list[i];
    	child_ctx[18] = i;
    	return child_ctx;
    }

    function get_each_context_1(ctx, list, i) {
    	const child_ctx = ctx.slice();
    	child_ctx[16] = list[i];
    	return child_ctx;
    }

    // (59:8) {#each formToolList as item}
    function create_each_block_1(ctx) {
    	let button;
    	let t_value = /*item*/ ctx[16].prototype.getTitle() + "";
    	let t;
    	let mounted;
    	let dispose;

    	function click_handler(...args) {
    		return /*click_handler*/ ctx[9](/*item*/ ctx[16], ...args);
    	}

    	const block = {
    		c: function create() {
    			button = element("button");
    			t = text(t_value);
    			attr_dev(button, "class", "svelte-1x6ixjb");
    			add_location(button, file, 59, 12, 1613);
    		},
    		m: function mount(target, anchor) {
    			insert_dev(target, button, anchor);
    			append_dev(button, t);

    			if (!mounted) {
    				dispose = listen_dev(button, "click", click_handler, false, false, false);
    				mounted = true;
    			}
    		},
    		p: function update(new_ctx, dirty) {
    			ctx = new_ctx;
    		},
    		d: function destroy(detaching) {
    			if (detaching) detach_dev(button);
    			mounted = false;
    			dispose();
    		}
    	};

    	dispatch_dev("SvelteRegisterBlock", {
    		block,
    		id: create_each_block_1.name,
    		type: "each",
    		source: "(59:8) {#each formToolList as item}",
    		ctx
    	});

    	return block;
    }

    // (64:8) {#each formItems as item, index}
    function create_each_block(ctx) {
    	let switch_instance;
    	let switch_instance_anchor;
    	let current;

    	function func() {
    		return /*func*/ ctx[10](/*index*/ ctx[18]);
    	}

    	function func_1() {
    		return /*func_1*/ ctx[11](/*index*/ ctx[18]);
    	}

    	var switch_value = /*item*/ ctx[16]['obj'];

    	function switch_props(ctx) {
    		return {
    			props: {
    				settings: /*item*/ ctx[16]['settings'],
    				index: /*index*/ ctx[18],
    				removeFormItem: func,
    				showEditForm: func_1
    			},
    			$$inline: true
    		};
    	}

    	if (switch_value) {
    		switch_instance = construct_svelte_component_dev(switch_value, switch_props(ctx));
    	}

    	const block = {
    		c: function create() {
    			if (switch_instance) create_component(switch_instance.$$.fragment);
    			switch_instance_anchor = empty();
    		},
    		m: function mount(target, anchor) {
    			if (switch_instance) mount_component(switch_instance, target, anchor);
    			insert_dev(target, switch_instance_anchor, anchor);
    			current = true;
    		},
    		p: function update(new_ctx, dirty) {
    			ctx = new_ctx;
    			const switch_instance_changes = {};
    			if (dirty & /*formItems*/ 2) switch_instance_changes.settings = /*item*/ ctx[16]['settings'];

    			if (switch_value !== (switch_value = /*item*/ ctx[16]['obj'])) {
    				if (switch_instance) {
    					group_outros();
    					const old_component = switch_instance;

    					transition_out(old_component.$$.fragment, 1, 0, () => {
    						destroy_component(old_component, 1);
    					});

    					check_outros();
    				}

    				if (switch_value) {
    					switch_instance = construct_svelte_component_dev(switch_value, switch_props(ctx));
    					create_component(switch_instance.$$.fragment);
    					transition_in(switch_instance.$$.fragment, 1);
    					mount_component(switch_instance, switch_instance_anchor.parentNode, switch_instance_anchor);
    				} else {
    					switch_instance = null;
    				}
    			} else if (switch_value) {
    				switch_instance.$set(switch_instance_changes);
    			}
    		},
    		i: function intro(local) {
    			if (current) return;
    			if (switch_instance) transition_in(switch_instance.$$.fragment, local);
    			current = true;
    		},
    		o: function outro(local) {
    			if (switch_instance) transition_out(switch_instance.$$.fragment, local);
    			current = false;
    		},
    		d: function destroy(detaching) {
    			if (detaching) detach_dev(switch_instance_anchor);
    			if (switch_instance) destroy_component(switch_instance, detaching);
    		}
    	};

    	dispatch_dev("SvelteRegisterBlock", {
    		block,
    		id: create_each_block.name,
    		type: "each",
    		source: "(64:8) {#each formItems as item, index}",
    		ctx
    	});

    	return block;
    }

    // (74:4) {#if editItem}
    function create_if_block(ctx) {
    	let div;
    	let editform;
    	let updating_isRequired;
    	let current;

    	function editform_isRequired_binding(value) {
    		/*editform_isRequired_binding*/ ctx[13](value);
    	}

    	let editform_props = {
    		closeEditForm: /*func_2*/ ctx[12],
    		itemTitle: /*itemTitle*/ ctx[3]
    	};

    	if (/*isRequired*/ ctx[0] !== void 0) {
    		editform_props.isRequired = /*isRequired*/ ctx[0];
    	}

    	editform = new EditForm({ props: editform_props, $$inline: true });
    	binding_callbacks.push(() => bind(editform, 'isRequired', editform_isRequired_binding, /*isRequired*/ ctx[0]));

    	const block = {
    		c: function create() {
    			div = element("div");
    			create_component(editform.$$.fragment);
    			attr_dev(div, "class", "editForm");
    			add_location(div, file, 74, 8, 2126);
    		},
    		m: function mount(target, anchor) {
    			insert_dev(target, div, anchor);
    			mount_component(editform, div, null);
    			current = true;
    		},
    		p: function update(ctx, dirty) {
    			const editform_changes = {};
    			if (dirty & /*itemTitle*/ 8) editform_changes.itemTitle = /*itemTitle*/ ctx[3];

    			if (!updating_isRequired && dirty & /*isRequired*/ 1) {
    				updating_isRequired = true;
    				editform_changes.isRequired = /*isRequired*/ ctx[0];
    				add_flush_callback(() => updating_isRequired = false);
    			}

    			editform.$set(editform_changes);
    		},
    		i: function intro(local) {
    			if (current) return;
    			transition_in(editform.$$.fragment, local);
    			current = true;
    		},
    		o: function outro(local) {
    			transition_out(editform.$$.fragment, local);
    			current = false;
    		},
    		d: function destroy(detaching) {
    			if (detaching) detach_dev(div);
    			destroy_component(editform);
    		}
    	};

    	dispatch_dev("SvelteRegisterBlock", {
    		block,
    		id: create_if_block.name,
    		type: "if",
    		source: "(74:4) {#if editItem}",
    		ctx
    	});

    	return block;
    }

    function create_fragment(ctx) {
    	let div2;
    	let div0;
    	let t0;
    	let div1;
    	let t1;
    	let current;
    	let each_value_1 = /*formToolList*/ ctx[4];
    	validate_each_argument(each_value_1);
    	let each_blocks_1 = [];

    	for (let i = 0; i < each_value_1.length; i += 1) {
    		each_blocks_1[i] = create_each_block_1(get_each_context_1(ctx, each_value_1, i));
    	}

    	let each_value = /*formItems*/ ctx[1];
    	validate_each_argument(each_value);
    	let each_blocks = [];

    	for (let i = 0; i < each_value.length; i += 1) {
    		each_blocks[i] = create_each_block(get_each_context(ctx, each_value, i));
    	}

    	const out = i => transition_out(each_blocks[i], 1, 1, () => {
    		each_blocks[i] = null;
    	});

    	let if_block = /*editItem*/ ctx[2] && create_if_block(ctx);

    	const block = {
    		c: function create() {
    			div2 = element("div");
    			div0 = element("div");

    			for (let i = 0; i < each_blocks_1.length; i += 1) {
    				each_blocks_1[i].c();
    			}

    			t0 = space();
    			div1 = element("div");

    			for (let i = 0; i < each_blocks.length; i += 1) {
    				each_blocks[i].c();
    			}

    			t1 = space();
    			if (if_block) if_block.c();
    			add_location(div0, file, 57, 4, 1556);
    			add_location(div1, file, 62, 4, 1731);
    			attr_dev(div2, "class", "form-builder");
    			add_location(div2, file, 56, 0, 1524);
    		},
    		l: function claim(nodes) {
    			throw new Error("options.hydrate only works if the component was compiled with the `hydratable: true` option");
    		},
    		m: function mount(target, anchor) {
    			insert_dev(target, div2, anchor);
    			append_dev(div2, div0);

    			for (let i = 0; i < each_blocks_1.length; i += 1) {
    				each_blocks_1[i].m(div0, null);
    			}

    			append_dev(div2, t0);
    			append_dev(div2, div1);

    			for (let i = 0; i < each_blocks.length; i += 1) {
    				each_blocks[i].m(div1, null);
    			}

    			append_dev(div2, t1);
    			if (if_block) if_block.m(div2, null);
    			current = true;
    		},
    		p: function update(ctx, [dirty]) {
    			if (dirty & /*addFormItem, formToolList*/ 48) {
    				each_value_1 = /*formToolList*/ ctx[4];
    				validate_each_argument(each_value_1);
    				let i;

    				for (i = 0; i < each_value_1.length; i += 1) {
    					const child_ctx = get_each_context_1(ctx, each_value_1, i);

    					if (each_blocks_1[i]) {
    						each_blocks_1[i].p(child_ctx, dirty);
    					} else {
    						each_blocks_1[i] = create_each_block_1(child_ctx);
    						each_blocks_1[i].c();
    						each_blocks_1[i].m(div0, null);
    					}
    				}

    				for (; i < each_blocks_1.length; i += 1) {
    					each_blocks_1[i].d(1);
    				}

    				each_blocks_1.length = each_value_1.length;
    			}

    			if (dirty & /*formItems, removeFormItem, showEditForm*/ 194) {
    				each_value = /*formItems*/ ctx[1];
    				validate_each_argument(each_value);
    				let i;

    				for (i = 0; i < each_value.length; i += 1) {
    					const child_ctx = get_each_context(ctx, each_value, i);

    					if (each_blocks[i]) {
    						each_blocks[i].p(child_ctx, dirty);
    						transition_in(each_blocks[i], 1);
    					} else {
    						each_blocks[i] = create_each_block(child_ctx);
    						each_blocks[i].c();
    						transition_in(each_blocks[i], 1);
    						each_blocks[i].m(div1, null);
    					}
    				}

    				group_outros();

    				for (i = each_value.length; i < each_blocks.length; i += 1) {
    					out(i);
    				}

    				check_outros();
    			}

    			if (/*editItem*/ ctx[2]) {
    				if (if_block) {
    					if_block.p(ctx, dirty);

    					if (dirty & /*editItem*/ 4) {
    						transition_in(if_block, 1);
    					}
    				} else {
    					if_block = create_if_block(ctx);
    					if_block.c();
    					transition_in(if_block, 1);
    					if_block.m(div2, null);
    				}
    			} else if (if_block) {
    				group_outros();

    				transition_out(if_block, 1, 1, () => {
    					if_block = null;
    				});

    				check_outros();
    			}
    		},
    		i: function intro(local) {
    			if (current) return;

    			for (let i = 0; i < each_value.length; i += 1) {
    				transition_in(each_blocks[i]);
    			}

    			transition_in(if_block);
    			current = true;
    		},
    		o: function outro(local) {
    			each_blocks = each_blocks.filter(Boolean);

    			for (let i = 0; i < each_blocks.length; i += 1) {
    				transition_out(each_blocks[i]);
    			}

    			transition_out(if_block);
    			current = false;
    		},
    		d: function destroy(detaching) {
    			if (detaching) detach_dev(div2);
    			destroy_each(each_blocks_1, detaching);
    			destroy_each(each_blocks, detaching);
    			if (if_block) if_block.d();
    		}
    	};

    	dispatch_dev("SvelteRegisterBlock", {
    		block,
    		id: create_fragment.name,
    		type: "component",
    		source: "",
    		ctx
    	});

    	return block;
    }

    function instance($$self, $$props, $$invalidate) {
    	let { $$slots: slots = {}, $$scope } = $$props;
    	validate_slots('App', slots, []);
    	let formToolList = [];
    	formToolList.push(EmailItem);
    	formToolList.push(TextareaItem);
    	formToolList.push(CheckboxItem);
    	formToolList.push(RadioItem);
    	let formItems = [];
    	let editItem = false;
    	let itemTitle = "";
    	let isRequired = true;
    	let itemIndex = 0;

    	function addFormItem(e, item) {
    		e.preventDefault();
    		let formItem = [];
    		formItem['obj'] = item;
    		formItem['settings'] = [];
    		formItem['settings']['isRequired'] = false;
    		$$invalidate(1, formItems = [...formItems, formItem]);
    	}

    	function removeFormItem(index) {
    		formItems.splice(index, 1);
    		$$invalidate(1, formItems);
    	}

    	function showEditForm(index) {
    		$$invalidate(2, editItem = true);
    		itemIndex = index;
    		$$invalidate(3, itemTitle = formItems[index]['obj'].prototype.getTitle());
    		$$invalidate(0, isRequired = formItems[itemIndex]['settings']['isRequired']);
    	}

    	function closeEditForm() {
    		$$invalidate(2, editItem = false);
    	}

    	function setRequired(isRequired) {
    		if (formItems.length > 0) {
    			$$invalidate(1, formItems[itemIndex]['settings']['isRequired'] = isRequired, formItems);
    		}
    	}

    	const writable_props = [];

    	Object.keys($$props).forEach(key => {
    		if (!~writable_props.indexOf(key) && key.slice(0, 2) !== '$$' && key !== 'slot') console.warn(`<App> was created with unknown prop '${key}'`);
    	});

    	const click_handler = (item, e) => addFormItem(e, item);
    	const func = index => removeFormItem(index);
    	const func_1 = index => showEditForm(index);
    	const func_2 = () => closeEditForm();

    	function editform_isRequired_binding(value) {
    		isRequired = value;
    		$$invalidate(0, isRequired);
    	}

    	$$self.$capture_state = () => ({
    		EmailItem,
    		TextareaItem,
    		CheckboxItem,
    		RadioItem,
    		EditForm,
    		formToolList,
    		formItems,
    		editItem,
    		itemTitle,
    		isRequired,
    		itemIndex,
    		addFormItem,
    		removeFormItem,
    		showEditForm,
    		closeEditForm,
    		setRequired
    	});

    	$$self.$inject_state = $$props => {
    		if ('formToolList' in $$props) $$invalidate(4, formToolList = $$props.formToolList);
    		if ('formItems' in $$props) $$invalidate(1, formItems = $$props.formItems);
    		if ('editItem' in $$props) $$invalidate(2, editItem = $$props.editItem);
    		if ('itemTitle' in $$props) $$invalidate(3, itemTitle = $$props.itemTitle);
    		if ('isRequired' in $$props) $$invalidate(0, isRequired = $$props.isRequired);
    		if ('itemIndex' in $$props) itemIndex = $$props.itemIndex;
    	};

    	if ($$props && "$$inject" in $$props) {
    		$$self.$inject_state($$props.$$inject);
    	}

    	$$self.$$.update = () => {
    		if ($$self.$$.dirty & /*isRequired*/ 1) {
    			setRequired(isRequired);
    		}
    	};

    	return [
    		isRequired,
    		formItems,
    		editItem,
    		itemTitle,
    		formToolList,
    		addFormItem,
    		removeFormItem,
    		showEditForm,
    		closeEditForm,
    		click_handler,
    		func,
    		func_1,
    		func_2,
    		editform_isRequired_binding
    	];
    }

    class App extends SvelteComponentDev {
    	constructor(options) {
    		super(options);
    		init(this, options, instance, create_fragment, safe_not_equal, {});

    		dispatch_dev("SvelteRegisterComponent", {
    			component: this,
    			tagName: "App",
    			options,
    			id: create_fragment.name
    		});
    	}
    }

    function EMB(target) {
            return new App({
                target: target,
            });

    }

    return EMB;

})();
//# sourceMappingURL=builder.js.map
