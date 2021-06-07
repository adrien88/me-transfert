export class EditorArea extends HTMLElement {
    constructor(opts = { id: "editorArea", class: "editorArea" }) {
        // define element
        customElements.define("editor-area", DropArea);

        // construire le parent (HTMLElement)
        super();
    }

    loadFile(File) {
        this.ctx = File.getContext("2d");
    }

    exportFile() {}
}
