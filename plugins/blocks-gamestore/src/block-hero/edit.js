import {
	useBlockProps,
	RichText,
	InspectorControls,
	MediaUpload,
	MediaPlaceholder,
} from "@wordpress/block-editor";
import {
	PanelBody,
	TextControl,
	TextareaControl,
	ToggleControl,
	Button,
} from "@wordpress/components";
import { useState } from "@wordpress/element";
import "./editor.scss";

const SlideItem = ({ index, slide, onImageChange, onRemove }) => {
	return (
		<div className="slide-item">
			<div className="slide-item-image">
				<p>Light Version Logo</p>
				{slide.lightImage && <img src={slide.lightImage} alt="Slide Image" />}
				<MediaPlaceholder
					icon="format-image"
					onSelect={(media) => onImageChange(media.url, index, "lightImage")}
					onSelectURL={(url) => onImageChange(url, index, "lightImage")}
					labels={{
						title: "Slide Light Image",
						instructions: "Upload an image for the slide.",
					}}
					accept="image/*"
					allowedTypes={["image"]}
					multiple={false}
				/>
			</div>
			<div className="slide-item-image">
				<p>Dark Version Logo</p>
				{slide.darkImage && <img src={slide.darkImage} alt="Slide Image" />}
				<MediaPlaceholder
					icon="format-image"
					onSelect={(media) => onImageChange(media.url, index, "darkImage")}
					onSelectURL={(url) => onImageChange(url, index, "darkImage")}
					labels={{
						title: "Slide Dark Image",
						instructions: "Upload an image for the slide.",
					}}
					accept="image/*"
					allowedTypes={["image"]}
					multiple={false}
				/>
			</div>
			<Button
				className="components-button is-destructive"
				onClick={() => onRemove(index)}
			>
				Remove
			</Button>
		</div>
	);
};

export default function Edit({ attributes, setAttributes }) {
	const { title, description, link, linkAnchor, video, isVideo, image } =
		attributes;
	const [isVideoUpload, setIsVideoUpload] = useState(isVideo);

	const [slides, setSlides] = useState([attributes.slides || []]);

	const onSlideChange = (updatedSlide, index) => {
		const updatedSlides = [...slides];
		updatedSlides[index] = updatedSlide;
		setSlides(updatedSlides);
		setAttributes({ slides: updatedSlides });
	};

	const addSlide = () => {
		setSlides([...slides, { image: "" }]);
	};

	const removeSlide = (index) => {
		const updatedSlides = [...slides];
		updatedSlides.splice(index, 1);
		setSlides(updatedSlides);
		setAttributes({ slides: updatedSlides });
	};

	const handleImageChange = (url, index) => {
		const updatedSlide = { ...slides[index], image: url };
		onSlideChange(updatedSlide, index);
	};

	return (
		<>
			<InspectorControls>
				<PanelBody title="Hero Settings">
					<TextControl
						label="Title"
						value={title}
						onChange={(title) => setAttributes({ title })}
					/>
					<TextareaControl
						label="Description"
						value={description}
						onChange={(description) => setAttributes({ description })}
					/>
					<TextControl
						label="Button URL"
						value={link}
						onChange={(link) => setAttributes({ link })}
					/>
					<TextControl
						label="Button Value"
						value={linkAnchor}
						onChange={(linkAnchor) => setAttributes({ linkAnchor })}
					/>
					<ToggleControl
						label="Upload Video"
						checked={isVideoUpload}
						onChange={(value) => {
							setIsVideoUpload(value);
							setAttributes({ isVideo: value, video: "", image: "" });
						}}
					/>

					{isVideoUpload
						? video && (
								<video controls muted>
									<source src={video} type="video/mp4" />
								</video>
						  )
						: image && <img src={image} alt="Uploaded" />}

					<MediaUpload
						onSelect={(media) => {
							if (isVideoUpload) {
								setAttributes({ video: media.url });
							} else {
								setAttributes({ image: media.url });
							}
						}}
						type={isVideoUpload ? ["video"] : ["image"]}
						render={({ open }) => (
							<button
								className="components-button is-secondary video-upload"
								onClick={open}
							>
								{isVideoUpload ? "Upload Video" : "Upload Image"}
							</button>
						)}
					/>
				</PanelBody>
				<PanelBody title="Hero Slider">
					{slides.map((slide, index) => (
						<SlideItem
							key={index}
							index={index}
							slide={slide}
							onImageChange={handleImageChange}
							onRemove={removeSlide}
						/>
					))}
					<Button className="components-button is-primary" onClick={addSlide}>
						Add Slide
					</Button>
				</PanelBody>
			</InspectorControls>
			<div {...useBlockProps()}>
				{video && (
					<video
						className="video-bg"
						loop="loop"
						autoplay=""
						muted
						playsinline
						width="100%"
						height="100%"
					>
						<source className="source-element" src={video} type="video/mp4" />
					</video>
				)}
				{image && <img className="image-big" src={image} alt="Background" />}
				<div className="hero-mask"></div>
				<div className="hero-content">
					<RichText
						tagName="h1"
						className="hero-title"
						value={title}
						onChange={(title) => setAttributes({ title })}
					/>
					<RichText
						tagName="p"
						className="hero-description"
						value={description}
						onChange={(description) => setAttributes({ description })}
					/>
					<a href={link} className="hero-button">
						{linkAnchor}
					</a>
				</div>
			</div>
		</>
	);
}
