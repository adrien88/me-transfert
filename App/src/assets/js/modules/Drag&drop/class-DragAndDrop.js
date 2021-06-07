import { FileHandler } from "../FilesHandler/class-FileHandler.js";

import { DropArea } from "./class-DropArea.js";
customElements.define("drop-area", DropArea);

import { ThumbsArea } from "./class-ThumbsArea.js";
customElements.define("thumbs-area", ThumbsArea);

export class DragAndDrop {
    constructor(param) {
        this.dropArea = new DropArea(param.DropArea);
        this.ThumbsArea = new ThumbsArea(param.ThumbsArea);

        this.listenDrop();

        let dropmodule = document.getElementById(param.DropTagId);
        dropmodule.appendChild(this.dropArea);
        dropmodule.appendChild(this.ThumbsArea);
    }

    listenDrop() {
        this.dropArea.bind((file) => {
            // add file
            file = new FileHandler(file);

            this.ThumbsArea.addEventListener("click", () => {
                // //
                // let EditorArea = new EditorArea();
                // //
                // EditorArea.deploy();
            });

            // rafraichir la liste des thumbnails
            this.ThumbsArea.refresh();
        });
    }
}
