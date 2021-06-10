export class DropArea extends HTMLElement {
    constructor(opts = { id: "dropArea", class: "dropArea" }) {
        // construire le parent (HTMLElement)
        super();

        // assigner ID et class
        this.id = opts.id;
        this.classList.add(opts.class);
        this.style.display = "block";
        this.style.padding = "2em";
        this.style.margin = ".5em";
        this.style.border = "1px solid gray";
        this.innerText = "Drag & drop your files here !";

    }

    /**
     *  
     */
    bind(callable) {

        /**
         * Stop default browser
         */
        this.addEventListener("dragover", (e) => {
            e.preventDefault();
            this.style.cursor = "grab";
        });

        /**
         * Move default action to
         */
        this.addEventListener("drop", (e) => {
            e.preventDefault();

            if (e.dataTransfer.items)
                for (const item of e.dataTransfer.items) {
                    // récupère chaque objet comme un fichier
                    callable(item.getAsFile());
                }
        });
    }
}
