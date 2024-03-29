wp.blocks.registerBlockVariation("core/post-terms", {
	name: "activity_materials_query",
	title: "Activity Materials",
	icon: "admin-appearance",
	description: "Display the materials used in the activity.",
	isDefault: false,
	attributes: {
		term: "materials",
		query: { post_type: "activity" },
		providerNameSlug: "activity-materials",
	},
});

wp.blocks.registerBlockVariation("core/post-terms", {
	name: "activity_types_query",
	title: "Activity Types",
	icon: "category",
	description: "Display the types of activities.",
	isDefault: false,
	attributes: {
		term: "a-type",
		query: { post_type: "activity" },
		providerNameSlug: "activity-types",
	},
});

wp.blocks.registerBlockVariation("core/post-terms", {
	name: "activity_effort_levels_query",
	title: "Activity Effort",
	icon: "performance",
	description: "Display the effort levels of activities.",
	isDefault: false,
	attributes: {
		term: "effort",
		query: { post_type: "activity" },
		providerNameSlug: "activity-effort-levels",
	},
});

wp.blocks.registerBlockStyle("core/query-pagination-previous", {
	name: "previous-activity",
	label: "Previous Activity",
});

wp.blocks.registerBlockStyle("core/query-pagination-next", {
	name: "next-activity",
	label: "Next Activity",
});

wp.blocks.registerBlockStyle("core/post-navigation-link", {
	name: "nav-activity",
	label: "Nav Activity",
});

wp.blocks.registerBlockStyle("core/post-template", {
	name: "activity-template",
	label: "Activity Template",
});

wp.blocks.registerBlockStyle("core/post-title", {
	name: "activity-title",
	label: "Activity Title",
});

wp.blocks.registerBlockStyle("core/post-excerpt", {
	name: "activity-excerpt",
	label: "Activity Excerpt",
});
