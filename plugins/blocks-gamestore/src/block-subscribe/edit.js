import { __ } from "@wordpress/i18n";
import {
	useBlockProps,
	InspectorControls,
	MediaPlaceholder,
	RichText,
} from "@wordpress/block-editor";
import { PanelBody, TextControl, TextareaControl } from "@wordpress/components";
import "./editor.scss";

export default function Edit({ attributes, setAttributes }) {
	const { shortcode, title, description, image } = attributes;
	return (
		<>
			<InspectorControls>
				<PanelBody title={__("Settings", "block-gamestore")}>
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
					<br />
					<br />
					<TextControl
						label={__("Shortcode", "block-gamestore")}
						value={shortcode}
						onChange={(val) => setAttributes({ shortcode: val })}
					/>
				</PanelBody>
			</InspectorControls>

			<div
				{...useBlockProps({
					className: "alignfull",
					style: {
						background: image ? `url(${image})` : undefined,
					},
				})}
			>
				<div class="subscribe-inner wrapper">
					<RichText
						tagName="h2"
						className="subscribe-title"
						value={title}
						onChange={(title) => setAttributes({ title })}
					/>
					<RichText
						tagName="p"
						className="subscribe-description"
						value={description}
						onChange={(description) => setAttributes({ description })}
					/>
				</div>
			</div>
		</>
	);
}
