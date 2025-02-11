import { __ } from "@wordpress/i18n";
import { useBlockProps, InspectorControls } from "@wordpress/block-editor";
import { PanelBody, TextControl, TextareaControl } from "@wordpress/components";
import ServerSideRender from "@wordpress/server-side-render";
import "./editor.scss";

export default function Edit({ attributes, setAttributes }) {
	const { count, title, description } = attributes;
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
				</PanelBody>
			</InspectorControls>

			<div {...useBlockProps()}></div>
			<ServerSideRender
				block="blocks-gamestore/featured-products"
				attributes={attributes}
			/>
		</>
	);
}
