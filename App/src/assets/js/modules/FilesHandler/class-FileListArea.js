import { FileList } from "./class-FileList.js";

export class FileListArea extends HTMLElement {
    constructor(opts = { id: "FileListArea", class: "FileListArea", listname: ''}) {
        // construire le parent (HTMLElement)
        super();
        
        // assigner ID et class
        this.id = opts.id;
        this.classList.add(opts.class);
        this.style.display = "block";
        
        // create file liste
        this.list = FileList.getList(opts.listname);

        // binding to list events
        this.binder();

        // create html table
        this.createTable();
    }

    /**
     * Binding object to a file list.
     */
    binder() {
        this.list.bind((act, key, file) => {
            switch (act) {
                case "set":
                    this.addFile(key, file);
                    break;
                case "unset":
                    this.removeFile(key);
                    break;
                default:
                    break;
            }
        });
    }

    /**
     * Create table if not exist.
     */
    createTable() {
        if (0 == this.children.length) {
            this.table = document.createElement("table");

            let thead = document.createElement("thead");
            this.tbody = document.createElement("tbody");
            let tfoot = document.createElement("tfoot");

            let tr = document.createElement("tr");

            let td = document.createElement("td");
            tr.innerText = "[action ]";
            tr.appendChild(td);

            td = document.createElement("td");
            td.innerText = "Filename";
            tr.appendChild(td);
            td = document.createElement("td");
            td.innerText = "Type";
            tr.appendChild(td);

            td = document.createElement("td");
            td.innerText = "Size";
            tr.appendChild(td);

            thead.appendChild(tr.cloneNode());
            tfoot.appendChild(tr.cloneNode());

            this.table.appendChild(thead);
            this.table.appendChild(this.tbody);
            this.table.appendChild(tfoot);
            this.appendChild(this.table);
        }
    }

    /**
     * Add File to table.
     *
     * @param {*} file
     */
    addFile(key, file) {
        let tr = document.createElement("tr");
        tr.id = key;

        let td = document.createElement("td");
        let del = document.createElement("button");
        del.innerText = "DEL";
        del.addEventListener("click", (e) => {
            this.list.unset(key);
            this.remove(key);
        });
        td.appendChild(del);
        tr.appendChild(td);

        td = document.createElement("td");
        td.innerText = file.name;
        tr.appendChild(td);

        td = document.createElement("td");
        td.innerText = file.type;
        tr.appendChild(td);

        td = document.createElement("td");
        td.innerText = file.size;
        tr.appendChild(td);

        this.tbody.appendChild(tr);
    }

    /**
     * Remove from list
     *
     * @param {*} key
     */
    removeFile(key) {
        for (const child of this.table.children) {
            if (key === child.id) this.table.removeChild(child);
        }
    }
}
