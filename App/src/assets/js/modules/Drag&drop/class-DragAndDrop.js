import { FileHandler } from "../FilesHandler/class-FileHandler.js";
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


        //  drop area
        this.dropArea = new DropArea(param.DropArea);
        this.list = FileList.getList("class-DragAndDrop");

        // ThumbsArea: { id: "thumbsArea", class: "thumbsArea" },
        if (null != param.ThumbsArea){
            this.ThumbsArea = new ThumbsArea(param.ThumbsArea);
        }
        
        // FileListArea: { id: "thumbsArea", class: "thumbsArea" },
        if (null != param.FileListArea){
            param.FileListArea.listname = "class-DragAndDrop";
            this.FileListArea = new FileListArea(param.FileListArea);
        }

        // Form: { id: "", async: false },
        // if (null != param.Form)
        //     let form = document.getElementById(param.Form.id);

        this.dropArea.bind((file) => {
            file.uri = URL.createObjectURL(file);   //  unique key random generator 
            file.imported = Date.now();             // int: date importation
            file.blob = file.stream();              // content
            this.list.set(file);
        });

        let dropmodule = document.getElementById(param.DropTagId);
        dropmodule.appendChild(this.dropArea);

        // if (null != this.ThumbsArea) dropmodule.appendChild(this.ThumbsArea);
        if (null != this.FileListArea) dropmodule.appendChild(this.FileListArea);
    }
}
