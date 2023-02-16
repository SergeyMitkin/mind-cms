var EMB=function(){"use strict";function t(){}function e(t){return t()}function n(){return Object.create(null)}function o(t){t.forEach(e)}function i(t){return"function"==typeof t}function s(t,e){return t!=t?e==e:t!==e||t&&"object"==typeof t||"function"==typeof t}function l(t,e){t.appendChild(e)}function r(t,e,n){t.insertBefore(e,n||null)}function c(t){t.parentNode&&t.parentNode.removeChild(t)}function u(t){return document.createElement(t)}function a(t){return document.createTextNode(t)}function d(){return a(" ")}function f(t,e,n,o){return t.addEventListener(e,n,o),()=>t.removeEventListener(e,n,o)}function m(t,e,n){null==n?t.removeAttribute(e):t.getAttribute(e)!==n&&t.setAttribute(e,n)}function p(t,e){e=""+e,t.wholeText!==e&&(t.data=e)}function h(t,e,n,o){null===n?t.style.removeProperty(e):t.style.setProperty(e,n,o?"important":"")}function g(t,e){for(let n=0;n<t.options.length;n+=1){const o=t.options[n];if(o.__value===e)return void(o.selected=!0)}t.selectedIndex=-1}let v;function $(t){v=t}const x=[],y=[],_=[],b=[],k=Promise.resolve();let I=!1;function w(t){_.push(t)}const E=new Set;let F=0;function q(){const t=v;do{for(;F<x.length;){const t=x[F];F++,$(t),C(t.$$)}for($(null),x.length=0,F=0;y.length;)y.pop()();for(let t=0;t<_.length;t+=1){const e=_[t];E.has(e)||(E.add(e),e())}_.length=0}while(x.length);for(;b.length;)b.pop()();I=!1,E.clear(),$(t)}function C(t){if(null!==t.fragment){t.update(),o(t.before_update);const e=t.dirty;t.dirty=[-1],t.fragment&&t.fragment.p(t.ctx,e),t.after_update.forEach(w)}}const R=new Set;let T;function j(){T={r:0,c:[],p:T}}function N(){T.r||o(T.c),T=T.p}function P(t,e){t&&t.i&&(R.delete(t),t.i(e))}function A(t,e,n,o){if(t&&t.o){if(R.has(t))return;R.add(t),T.c.push((()=>{R.delete(t),o&&(n&&t.d(1),o())})),t.o(e)}else o&&o()}function L(t){t&&t.c()}function M(t,n,s,l){const{fragment:r,after_update:c}=t.$$;r&&r.m(n,s),l||w((()=>{const n=t.$$.on_mount.map(e).filter(i);t.$$.on_destroy?t.$$.on_destroy.push(...n):o(n),t.$$.on_mount=[]})),c.forEach(w)}function B(t,e){const n=t.$$;null!==n.fragment&&(o(n.on_destroy),n.fragment&&n.fragment.d(e),n.on_destroy=n.fragment=null,n.ctx=[])}function O(t,e){-1===t.$$.dirty[0]&&(x.push(t),I||(I=!0,k.then(q)),t.$$.dirty.fill(0)),t.$$.dirty[e/31|0]|=1<<e%31}function S(e,i,s,l,r,u,a,d=[-1]){const f=v;$(e);const m=e.$$={fragment:null,ctx:[],props:u,update:t,not_equal:r,bound:n(),on_mount:[],on_destroy:[],on_disconnect:[],before_update:[],after_update:[],context:new Map(i.context||(f?f.$$.context:[])),callbacks:n(),dirty:d,skip_bound:!1,root:i.target||f.$$.root};a&&a(m.root);let p=!1;if(m.ctx=s?s(e,i.props||{},((t,n,...o)=>{const i=o.length?o[0]:n;return m.ctx&&r(m.ctx[t],m.ctx[t]=i)&&(!m.skip_bound&&m.bound[t]&&m.bound[t](i),p&&O(e,t)),n})):[],m.update(),p=!0,o(m.before_update),m.fragment=!!l&&l(m.ctx),i.target){if(i.hydrate){const t=function(t){return Array.from(t.childNodes)}(i.target);m.fragment&&m.fragment.l(t),t.forEach(c)}else m.fragment&&m.fragment.c();i.intro&&P(e.$$.fragment),M(e,i.target,i.anchor,i.customElement),q()}$(f)}class H{$destroy(){B(this,1),this.$destroy=t}$on(e,n){if(!i(n))return t;const o=this.$$.callbacks[e]||(this.$$.callbacks[e]=[]);return o.push(n),()=>{const t=o.indexOf(n);-1!==t&&o.splice(t,1)}}$set(t){var e;this.$$set&&(e=t,0!==Object.keys(e).length)&&(this.$$.skip_bound=!0,this.$$set(t),this.$$.skip_bound=!1)}}function z(t){let e,n,o;return{c(){e=u("div"),e.innerHTML='<i class="is-isolated fa fa-trash"></i>',m(e,"class","btn is-isolated")},m(s,l){r(s,e,l),n||(o=f(e,"click",(function(){i(t[2])&&t[2].apply(this,arguments)})),n=!0)},p(e,n){t=e},d(t){t&&c(e),n=!1,o()}}}function D(t){let e,n,o,s;return{c(){e=u("div"),n=u("button"),n.textContent="Добавить поле",m(n,"class","add_field_button"),m(e,"class","col-sm-2 add_field_button_wrap svelte-ohye6x")},m(c,u){r(c,e,u),l(e,n),o||(s=f(n,"click",(function(){i(t[1])&&t[1].apply(this,arguments)})),o=!0)},p(e,n){t=e},d(t){t&&c(e),o=!1,s()}}}function W(e){let n,o,s,h,g,v,$,x,y,_,b,k,I,w,E,F,q,C,R,T,j,N,P,A,L,M,B,O,S,H,W,G,J,K,Q,U,V,X,Y=e[4].type+"",Z=0!==e[0]&&z(e),tt=0===e[0]&&D(e);return{c(){n=u("div"),o=u("div"),s=u("div"),h=d(),g=u("div"),v=u("span"),$=a(Y),x=d(),y=u("div"),_=u("div"),_.innerHTML='<i class="is-isolated fa fa-edit"></i>',b=d(),Z&&Z.c(),k=d(),I=u("div"),w=d(),E=u("div"),F=u("label"),F.textContent="Название поля",q=d(),C=u("div"),R=u("input"),j=d(),tt&&tt.c(),N=d(),P=u("div"),A=u("label"),A.textContent="Input name",L=d(),M=u("div"),B=u("input"),S=d(),H=u("input"),J=d(),K=u("input"),m(s,"class","col-sm-2"),m(v,"class","badge svelte-ohye6x"),m(_,"class","btn is-isolated"),m(y,"class","toolbar-header-buttons"),m(g,"class","col-sm-8 toolbar-header svelte-ohye6x"),m(I,"class","col-sm-2"),m(o,"class","field-header svelte-ohye6x"),m(F,"for","field-title"),m(F,"class","col-sm-2 control-label svelte-ohye6x"),m(R,"id","field-title"),m(R,"type","text"),m(R,"class","form-control"),m(R,"name",T="fields["+e[0]+"][name]"),m(C,"class","col-sm-8 control-input svelte-ohye6x"),m(E,"class","form-group"),m(A,"for","input-name"),m(A,"class","col-sm-2 control-label svelte-ohye6x"),m(B,"id","input-name"),m(B,"type","text"),m(B,"class","form-control"),m(B,"name",O="fields["+e[0]+"][name_in_form]"),m(M,"class","col-sm-8 control-input svelte-ohye6x"),m(P,"class","form-group"),H.hidden=!0,m(H,"type","text"),m(H,"name",W="fields["+e[0]+"][type]"),H.value=G=e[4].type,K.hidden=!0,m(K,"type","checkbox"),m(K,"name",Q="fields["+e[0]+"][is_required]"),K.checked=U=e[4].isRequired,m(n,"class","additional_field")},m(t,c){r(t,n,c),l(n,o),l(o,s),l(o,h),l(o,g),l(g,v),l(v,$),l(g,x),l(g,y),l(y,_),l(y,b),Z&&Z.m(y,null),l(o,k),l(o,I),l(n,w),l(n,E),l(E,F),l(E,q),l(E,C),l(C,R),l(E,j),tt&&tt.m(E,null),l(n,N),l(n,P),l(P,A),l(P,L),l(P,M),l(M,B),l(n,S),l(n,H),l(n,J),l(n,K),V||(X=f(_,"click",(function(){i(e[3])&&e[3].apply(this,arguments)})),V=!0)},p(t,[n]){e=t,16&n&&Y!==(Y=e[4].type+"")&&p($,Y),0!==e[0]?Z?Z.p(e,n):(Z=z(e),Z.c(),Z.m(y,null)):Z&&(Z.d(1),Z=null),1&n&&T!==(T="fields["+e[0]+"][name]")&&m(R,"name",T),0===e[0]?tt?tt.p(e,n):(tt=D(e),tt.c(),tt.m(E,null)):tt&&(tt.d(1),tt=null),1&n&&O!==(O="fields["+e[0]+"][name_in_form]")&&m(B,"name",O),1&n&&W!==(W="fields["+e[0]+"][type]")&&m(H,"name",W),16&n&&G!==(G=e[4].type)&&H.value!==G&&(H.value=G),1&n&&Q!==(Q="fields["+e[0]+"][is_required]")&&m(K,"name",Q),16&n&&U!==(U=e[4].isRequired)&&(K.checked=U)},i:t,o:t,d(t){t&&c(n),Z&&Z.d(),tt&&tt.d(),V=!1,X()}}}function G(t,e,n){let{index:o=0}=e,{addFormItem:i=(()=>"")}=e,{removeFormItem:s=(()=>"")}=e,{showEditForm:l=(()=>"")}=e,{settings:r=[]}=e;return t.$$set=t=>{"index"in t&&n(0,o=t.index),"addFormItem"in t&&n(1,i=t.addFormItem),"removeFormItem"in t&&n(2,s=t.removeFormItem),"showEditForm"in t&&n(3,l=t.showEditForm),"settings"in t&&n(4,r=t.settings)},[o,i,s,l,r]}class J extends H{constructor(t){super(),S(this,t,G,W,s,{index:0,addFormItem:1,removeFormItem:2,showEditForm:3,settings:4})}}function K(e){let n,s,v,$,x,y,_,b,k,I,E,F,q,C,R,T,j,N,P,A,L=e[0][e[2]].settings.title+"";return{c(){n=u("div"),s=u("div"),s.textContent="х",v=d(),$=u("h2"),x=a(L),y=d(),_=u("div"),b=u("select"),k=u("option"),k.textContent="Тип инпута",I=u("option"),I.textContent="Email",E=u("option"),E.textContent="Textarea",F=u("option"),F.textContent="Checkbox",q=u("option"),q.textContent="Radio",C=d(),R=u("div"),T=u("input"),j=d(),N=u("label"),N.textContent="Required",m(s,"class","closePanelWindow svelte-1uknk2w"),h($,"font-size","18px"),h($,"margin-bottom","0"),m($,"class","svelte-1uknk2w"),k.disabled=!0,k.__value="Тип инпута",k.value=k.__value,I.__value="email",I.value=I.__value,E.__value="textarea",E.value=E.__value,F.__value="checkbox",F.value=F.__value,q.__value="radio",q.value=q.__value,m(b,"id","type-select"),void 0===e[0][e[2]].settings.type&&w((()=>e[4].call(b))),m(_,"class","custom-control custom-select svelte-1uknk2w"),m(T,"id","is-requred"),m(T,"class","custom-control-input svelte-1uknk2w"),m(T,"type","checkbox"),m(N,"class","custom-control-label is-requred-label svelte-1uknk2w"),m(N,"for","is-requred"),m(R,"class","custom-control custom-checkbox svelte-1uknk2w"),m(n,"class","contentPanel svelte-1uknk2w")},m(t,o){r(t,n,o),l(n,s),l(n,v),l(n,$),l($,x),l(n,y),l(n,_),l(_,b),l(b,k),l(b,I),l(b,E),l(b,F),l(b,q),g(b,e[0][e[2]].settings.type),l(n,C),l(n,R),l(R,T),T.checked=e[0][e[2]].settings.isRequired,l(R,j),l(R,N),P||(A=[f(s,"click",(function(){i(e[1]())&&e[1]().apply(this,arguments)})),f(b,"change",e[4]),f(T,"change",e[5])],P=!0)},p(t,[n]){e=t,5&n&&L!==(L=e[0][e[2]].settings.title+"")&&p(x,L),5&n&&g(b,e[0][e[2]].settings.type),5&n&&(T.checked=e[0][e[2]].settings.isRequired)},i:t,o:t,d(t){t&&c(n),P=!1,o(A)}}}function Q(t,e,n){let{closeEditForm:o=(()=>"")}=e,{type:i="email"}=e,{itemIndex:s}=e,{formItems:l}=e;return t.$$set=t=>{"closeEditForm"in t&&n(1,o=t.closeEditForm),"type"in t&&n(3,i=t.type),"itemIndex"in t&&n(2,s=t.itemIndex),"formItems"in t&&n(0,l=t.formItems)},[l,o,s,i,function(){l[s].settings.type=function(t){const e=t.querySelector(":checked")||t.options[0];return e&&e.__value}(this),n(0,l)},function(){l[s].settings.isRequired=this.checked,n(0,l)}]}class U extends H{constructor(t){super(),S(this,t,Q,K,s,{closeEditForm:1,type:3,itemIndex:2,formItems:0})}}function V(t,e,n){const o=t.slice();return o[14]=e[n],o[16]=n,o}function X(t){let e,n,o,i,s;function a(e){t[11](e)}let f={closeEditForm:t[10],itemIndex:t[1]};return void 0!==t[0]&&(f.formItems=t[0]),n=new U({props:f}),y.push((()=>function(t,e,n,o){const i=t.$$.props[e];void 0!==i&&(t.$$.bound[i]=n,void 0===o&&n(t.$$.ctx[i]))}(n,"formItems",a,t[0]))),{c(){e=u("div"),L(n.$$.fragment),i=d(),m(e,"class","editForm")},m(t,o){r(t,e,o),M(n,e,null),l(e,i),s=!0},p(t,e){const i={};var s;2&e&&(i.itemIndex=t[1]),!o&&1&e&&(o=!0,i.formItems=t[0],s=()=>o=!1,b.push(s)),n.$set(i)},i(t){s||(P(n.$$.fragment,t),s=!0)},o(t){A(n.$$.fragment,t),s=!1},d(t){t&&c(e),B(n)}}}function Y(t){let e,n,o,i;e=new J({props:{settings:t[14].settings,index:t[16],addFormItem:t[7],removeFormItem:function(){return t[8](t[16])},showEditForm:function(){return t[9](t[16])}}});let s=t[2]&&t[16]===t[1]&&X(t);return{c(){L(e.$$.fragment),n=d(),s&&s.c(),o=a("")},m(t,l){M(e,t,l),r(t,n,l),s&&s.m(t,l),r(t,o,l),i=!0},p(n,i){t=n;const l={};1&i&&(l.settings=t[14].settings),e.$set(l),t[2]&&t[16]===t[1]?s?(s.p(t,i),6&i&&P(s,1)):(s=X(t),s.c(),P(s,1),s.m(o.parentNode,o)):s&&(j(),A(s,1,1,(()=>{s=null})),N())},i(t){i||(P(e.$$.fragment,t),P(s),i=!0)},o(t){A(e.$$.fragment,t),A(s),i=!1},d(t){B(e,t),t&&c(n),s&&s.d(t),t&&c(o)}}}function Z(t){let e,n,o=t[0],i=[];for(let e=0;e<o.length;e+=1)i[e]=Y(V(t,o,e));const s=t=>A(i[t],1,1,(()=>{i[t]=null}));return{c(){e=u("div");for(let t=0;t<i.length;t+=1)i[t].c();m(e,"class","form-builder")},m(t,o){r(t,e,o);for(let t=0;t<i.length;t+=1)i[t].m(e,null);n=!0},p(t,[n]){if(127&n){let l;for(o=t[0],l=0;l<o.length;l+=1){const s=V(t,o,l);i[l]?(i[l].p(s,n),P(i[l],1)):(i[l]=Y(s),i[l].c(),P(i[l],1),i[l].m(e,null))}for(j(),l=o.length;l<i.length;l+=1)s(l);N()}},i(t){if(!n){for(let t=0;t<o.length;t+=1)P(i[t]);n=!0}},o(t){i=i.filter(Boolean);for(let t=0;t<i.length;t+=1)A(i[t]);n=!1},d(t){t&&c(e),function(t,e){for(let n=0;n<t.length;n+=1)t[n]&&t[n].d(e)}(i,t)}}}function tt(t,e,n){let o=[],i=[];i.obj=J,i.settings=[],i.settings.isRequired=!1,i.settings.type="email",i.settings.title="Email",o=[...o,i];let s=!1,l=0;function r(t){t.preventDefault();let e=[];e.obj=J,e.settings=[],e.settings.isRequired=!1,e.settings.type="email",e.settings.title="Email",n(0,o=[...o,e])}function c(t){0!==t&&(o.splice(t,1),n(0,o))}function u(t){n(2,s=!0),n(1,l=t)}function a(){n(2,s=!1)}return t.$$.update=()=>{3&t.$$.dirty&&function(t){switch(t){case"textarea":n(0,o[l].settings.title="Textarea",o);break;case"checkbox":n(0,o[l].settings.title="Checkbox",o);break;case"radio":n(0,o[l].settings.title="Radio",o);break;default:n(0,o[l].settings.title="Email",o)}}(o[l].settings.type)},[o,l,s,r,c,u,a,t=>r(t),t=>c(t),t=>u(t),()=>a(),function(t){o=t,n(0,o)}]}class et extends H{constructor(t){super(),S(this,t,tt,Z,s,{})}}return function(t){return new et({target:t})}}();
//# sourceMappingURL=builder.js.map