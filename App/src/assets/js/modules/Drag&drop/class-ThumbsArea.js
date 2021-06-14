
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
   
  }
}
