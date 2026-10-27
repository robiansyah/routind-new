import { Link } from '@inertiajs/inertia-vue3';
import { __VLS_internalComponent, __VLS_componentsOption, __VLS_name } from './Pagination.vue';

function __VLS_template() {
let __VLS_ctx!: InstanceType<__VLS_PickNotAny<typeof __VLS_internalComponent, new () => {}>> & {};
/* Components */
let __VLS_otherComponents!: NonNullable<typeof __VLS_internalComponent extends { components: infer C; } ? C : {}> & typeof __VLS_componentsOption;
let __VLS_own!: __VLS_SelfComponent<typeof __VLS_name, typeof __VLS_internalComponent & (new () => { $slots: typeof __VLS_slots; })>;
let __VLS_localComponents!: typeof __VLS_otherComponents & Omit<typeof __VLS_own, keyof typeof __VLS_otherComponents>;
let __VLS_components!: typeof __VLS_localComponents & __VLS_GlobalComponents & typeof __VLS_ctx;
/* Style Scoped */
type __VLS_StyleScopedClasses = {};
let __VLS_styleScopedClasses!: __VLS_StyleScopedClasses | keyof __VLS_StyleScopedClasses | (keyof __VLS_StyleScopedClasses)[];
/* CSS variable injection */
/* CSS variable injection end */
let __VLS_resolvedLocalAndGlobalComponents!: {} &
__VLS_WithComponent<'Link', typeof __VLS_localComponents, "Link", "Link", "Link">;
__VLS_intrinsicElements.nav; __VLS_intrinsicElements.nav;
__VLS_intrinsicElements.ul; __VLS_intrinsicElements.ul;
__VLS_intrinsicElements.li; __VLS_intrinsicElements.li;
__VLS_components.Link; __VLS_components.Link;
// @ts-ignore
[Link, Link,];
{
const __VLS_0 = __VLS_intrinsicElements["nav"];
const __VLS_1 = __VLS_elementAsFunctionalComponent(__VLS_0);
const __VLS_2 = __VLS_1({ ...{}, }, ...__VLS_functionalComponentArgsRest(__VLS_1));
({} as (props: __VLS_FunctionalComponentProps<typeof __VLS_0, typeof __VLS_2> & Record<string, unknown>) => void)({ ...{}, });
const __VLS_3 = __VLS_pickFunctionalComponentCtx(__VLS_0, __VLS_2)!;
let __VLS_4!: __VLS_NormalizeEmits<typeof __VLS_3.emit>;
{
const __VLS_5 = __VLS_intrinsicElements["ul"];
const __VLS_6 = __VLS_elementAsFunctionalComponent(__VLS_5);
const __VLS_7 = __VLS_6({ ...{}, class: ((`pagination pagination-sm justify-content-${__VLS_ctx.align} mb-0 mt-4`)), }, ...__VLS_functionalComponentArgsRest(__VLS_6));
({} as (props: __VLS_FunctionalComponentProps<typeof __VLS_5, typeof __VLS_7> & Record<string, unknown>) => void)({ ...{}, class: ((`pagination pagination-sm justify-content-${__VLS_ctx.align} mb-0 mt-4`)), });
const __VLS_8 = __VLS_pickFunctionalComponentCtx(__VLS_5, __VLS_7)!;
let __VLS_9!: __VLS_NormalizeEmits<typeof __VLS_8.emit>;
for (const [link, index] of __VLS_getVForSourceType((__VLS_ctx.links)!)) {
{
const __VLS_10 = __VLS_intrinsicElements["li"];
const __VLS_11 = __VLS_elementAsFunctionalComponent(__VLS_10);
const __VLS_12 = __VLS_11({
...{}, class: (([
'page-item',
link.url == null ? 'disabled' : '',
link.active ? 'active' : '',
])), key: ((index)),
}, ...__VLS_functionalComponentArgsRest(__VLS_11));
({} as (props: __VLS_FunctionalComponentProps<typeof __VLS_10, typeof __VLS_12> & Record<string, unknown>) => void)({
...{}, class: (([
'page-item',
link.url == null ? 'disabled' : '',
link.active ? 'active' : '',
])), key: ((index)),
});
const __VLS_13 = __VLS_pickFunctionalComponentCtx(__VLS_10, __VLS_12)!;
let __VLS_14!: __VLS_NormalizeEmits<typeof __VLS_13.emit>;
{
let __VLS_15!: 'Link' extends keyof typeof __VLS_ctx ? typeof __VLS_ctx.Link : (typeof __VLS_resolvedLocalAndGlobalComponents)['Link'];
const __VLS_16 = __VLS_asFunctionalComponent(__VLS_15, new __VLS_15({ ...{}, class: ("page-link"), href: ((link.url === null ? '#' : link.url)), }));
({} as { Link: typeof __VLS_15; }).Link;
({} as { Link: typeof __VLS_15; }).Link;
const __VLS_17 = __VLS_16({ ...{}, class: ("page-link"), href: ((link.url === null ? '#' : link.url)), }, ...__VLS_functionalComponentArgsRest(__VLS_16));
({} as (props: __VLS_FunctionalComponentProps<typeof __VLS_15, typeof __VLS_17> & Record<string, unknown>) => void)({ ...{}, class: ("page-link"), href: ((link.url === null ? '#' : link.url)), });
const __VLS_18 = __VLS_pickFunctionalComponentCtx(__VLS_15, __VLS_17)!;
let __VLS_19!: __VLS_NormalizeEmits<typeof __VLS_18.emit>;
__VLS_directiveFunction(__VLS_ctx.vHtml)((link.label));
}
(__VLS_13.slots!).default;
}
// @ts-ignore
[align, align, links,];
}
(__VLS_8.slots!).default;
}
(__VLS_3.slots!).default;
}
if (typeof __VLS_styleScopedClasses === 'object' && !Array.isArray(__VLS_styleScopedClasses)) {
}
var __VLS_slots!: {};
return __VLS_slots;
}
