import { __ } from "@wordpress/i18n";
import { useBlockProps, InspectorControls } from "@wordpress/block-editor";
import { PanelBody, TextControl } from "@wordpress/components";
import ServerSideRender from "@wordpress/server-side-render";
import "./editor.scss";

export default function Edit({ attributes, setAttributes }) {
	const { count, title, link, linkAnchor } = attributes;
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
					<TextControl
						label={__("Link", "block-gamestore")}
						value={link}
						onChange={(link) => setAttributes({ link })}
					/>
					<TextControl
						label={__("Link Anchor", "block-gamestore")}
						value={linkAnchor}
						onChange={(linkAnchor) => setAttributes({ linkAnchor })}
					/>
				</PanelBody>
			</InspectorControls>

			<div {...useBlockProps()}></div>
			<ServerSideRender
				block="blocks-gamestore/similar-products"
				attributes={attributes}
			/>
		</>
	);
}
