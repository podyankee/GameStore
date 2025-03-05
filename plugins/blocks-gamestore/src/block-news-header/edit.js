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
	const { title, description, image } = attributes;
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
				<div class="wrapper">
					<RichText
						tagName="h1"
						className="news-header-title"
						value={title}
						onChange={(title) => setAttributes({ title })}
					/>
					<RichText
						tagName="p"
						className="news-header-description"
						value={description}
						onChange={(description) => setAttributes({ description })}
					/>
				</div>
			</div>
		</>
	);
}
