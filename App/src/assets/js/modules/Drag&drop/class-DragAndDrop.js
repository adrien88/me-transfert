import { FileList } from "../FilesHandler/class-FileList.js";
import { FileListArea } from "../FilesHandler/class-FileListArea.js";
customElements.define("filelist-area", FileListArea);

import { DropArea } from "./class-DropArea.js";
customElements.define("drop-area", DropArea);

import { ThumbsArea } from "./class-ThumbsArea.js";
customElements.define("thumbs-area", ThumbsArea);

/**
 * Main Class Drag & Drop
 */
export class DragAndDrop {
    constructor(param) {
        
        this.list = FileList.getList("class-DragAndDrop");

        // ThumbsArea: { id: "thumbsArea", class: "thumbsArea" },
        if (null != param.ThumbsArea) {
            this.ThumbsArea = new ThumbsArea(param.ThumbsArea);
        }

        // FileListArea: { id: "thumbsArea", class: "thumbsArea" },
        if (null != param.FileListArea) {
            param.FileListArea.listname = "class-DragAndDrop";
            this.FileListArea = new FileListArea(param.FileListArea);
        }

        this.dropArea = new DropArea(param.DropArea);
        this.dropArea.bind((file) => {

            // Need to bind URL from outer of ExFile : else it crash...
            // file.uri = URL.createObjectURL(file);
            
            if (null != param.Form) {
                // get form
                let form = document.getElementById(param.Form.id);
                // bind url
                file.url = form.getAttribute("action");
            }
            // if is async
            file.async = param.Form.async ?? false;
            // files ok
            this.list.set(file);
        });

        let dropmodule = document.getElementById(param.DropTagId);

        dropmodule.appendChild(this.dropArea);

        if (null != this.FileListArea)
            dropmodule.appendChild(this.FileListArea);
    }


}
