import { __ } from "@wordpress/i18n";
import {
	useBlockProps,
	InspectorControls,
	MediaPlaceholder,
} from "@wordpress/block-editor";
import { PanelBody, TextControl, TextareaControl } from "@wordpress/components";
import ServerSideRender from "@wordpress/server-side-render";
import "./editor.scss";

export default function Edit({ attributes, setAttributes }) {
	const { count, title, description, image } = attributes;
	return (
		<>
			<InspectorControls>
				<PanelBody title={__("Settings", "block-gamestore")}>
					<TextControl
						label={__("Count", "block-gamestore")}
						value={count}
						onChange={(val) => setAttributes({ count: parseInt(val, 10) || 0 })}
					/>
					<TextControl
						label={__("Title", "block-gamestore")}
						value={title}
						onChange={(title) => setAttributes({ title })}
					/>
					<TextareaControl
						label={__("Description", "block-gamestore")}
						value={description}
						onChange={(description) => setAttributes({ description })}
					/>
					{image && <img src={image} />}
					<MediaPlaceholder
						icon="format-image"
						labels={{ title: "Image" }}
						onSelect={(media) => setAttributes({ image: media.url })}
						accept="image/*"
						allowedTypes={["image"]}
						notices={["Image"]}
					/>
				</PanelBody>
			</InspectorControls>

			<div {...useBlockProps()}></div>
			<ServerSideRender
				block="blocks-gamestore/recent-news"
				attributes={attributes}
			/>
		</>
	);
}
