wp.blocks.registerBlockVariation("core/post-terms", {
	name: "activity_materials_query",
	title: "Activity Materials",
	icon: "admin-appearance",
	description: "Display the materials used in the activity.",
	isDefault: false,
	attributes: {
		term: "activity_materials",
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
		term: "activity_types",
		query: { post_type: "activity" },
		providerNameSlug: "activity-types",
	},
});

wp.blocks.registerBlockVariation("core/post-terms", {
	name: "activity_effort_levels_query",
	title: "Activity Effort Levels",
	icon: "performance",
	description: "Display the effort levels of activities.",
	isDefault: false,
	attributes: {
		term: "activity_effort_levels",
		query: { post_type: "activity" },
		providerNameSlug: "activity-effort-levels",
	},
});
