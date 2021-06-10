import { FileHandler } from "../FilesHandler/class-FileHandler.js";

export class ThumbsArea extends HTMLElement {
  static listPrinted = [];

  constructor(opts = { id: "thumbsArea", class: "thumbsArea" }) {
   
    // construire le parent (HTMLElement)
    super();

    // assigner ID et class
    this.id = opts.id;
    this.classList.add(opts.class);
    this.style.display = 'block';
    this.style.minHeight = '50px';
    this.style.minWidth = '150px';
    this.style.border = '1px dotted gray';
  }

  refresh() {
    for (const file of FileHandler.FilesList) {
      if (!ThumbsArea.listPrinted.includes(file.uri)) {
        ThumbsArea.listPrinted.push(file.uri);

        let img = new Image(100);
        img.setAttribute("src", file.uri);
        img.style.margin = ".5em";

        this.appendChild(img);
      }

      // console.log(file);
      // this.innerHTML = file.filename;
    }
  }
}
