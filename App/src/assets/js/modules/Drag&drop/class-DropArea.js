export class DropArea extends HTMLElement {
    constructor(opts = { id: "dropArea", class: "dropArea", message:'' }) {
        // construire le parent (HTMLElement)
        super();

        // assigner ID et class
        this.id = opts.id;
        this.classList.add(opts.class);
        this.style.display = "block";
        this.style.padding = "2em";
        this.style.margin = ".5em";
        this.style.border = "1px solid gray";
        this.innerText = opts.message;
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

        let button = this.makeHiddenButton(callable);
        this.addEventListener("click", (e) => {
            button.click();
        });
        this.appendChild(button);
    }

    /**
     * 
     * 
     * @param {callable} callable 
     * @returns 
     */
    makeHiddenButton(callable){
        let manual = document.createElement("input");
        manual.setAttribute("id", "filePiker");
        manual.setAttribute("type", "file");
        manual.style.display = "none";
        manual.addEventListener("change", (e) => {
            for (const file of manual.files) {
                callable(file);
                // this.list.set(this.prepareFile(file));
            }
            manual.defaultValue; // re-init button
        });

        return manual;
    }
}
