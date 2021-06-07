import { FileHandler } from "../FilesHandler/class-FileHandler.js";

export class Thumbs extends HTMLCanvasElement {
    constructor(opts = { id: null, class: "thumbnail" }) {
        customElements.define("thumbnail", DropArea);
        super();

        this.id = opts.id;
        this.classList.add(opts.class);
        this.style.display = "inline-block";
    }

    import(file) {
        if (file instanceof File)
            createImageBitmap(file).then((image) => {
                this.ctx = image.getContext("2d");
            });
    }

    export() {
        if (this.ctx != null && this.ctx instanceof CanvasRenderingContext2D) {
            // get cavans saize
            return this.ctx.getImageData();
        }
    }
}
