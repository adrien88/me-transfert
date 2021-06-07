export class HTMLPopupElement extends HTMLElement {
    static list = [];

    constructor(id, title = "unamed-popup", containerID = null, push = true) {
    
        // create 
        super();

        this.id = id;
        this.title = title;
        this.containerID = containerID ?? "popupContainer";

        this.classList.add("popup");

        // this.content = {};

        this.content = document.createElement("div");
        this.content.classList.add("content");
    }

    /**
     * remove
     */
    remove() {
        let parent = this.getContainer();
        parent.removeChild(this);

        // delete parent if empty
        if (parent.children.length == 0)
            parent.parentElement.removeChild(parent);
    }

    /**
     *
     * @param {*} elem
     * @param {*} key
     * @returns {*} key
     */
    add(elem, id = null) {
        if (elem instanceof HTMLElement) {
            elem.id = id ?? elem.id ?? Math.random()+'';
            this.content.appendChild(elem);
            console.log(elem.id)
            return elem.id;
        } else {
            let newelem = document.createElement("div");
            newelem.innerHTML = elem;
            this.add(newelem);
        }
    }

    /**
     *
     * @param {*} key
     */
    del(key) {
        for (const child of this.content.children)
            if (child.id == key) {
                this.content.removeChild(child);
                break;
            }
        if (this.content.children == 0) this.remove();
    }

    /**
     * 
     */
    push() {
        this.append(this.getTitleBar());
        this.append(this.content);
        this.getContainer().appendChild(this);
    }

    /**
     *
     * @returns
     */
    getTitleBar() {
        let titleBar = document.createElement("div");
        titleBar.classList.add("titleBar");

        
        let title = document.createElement("div");
        title.classList.add("title");
        title.style.padding = ".45em";
        title.innerHTML = this.title;

        titleBar.appendChild(title);

        let action = document.createElement("button");
        action.innerHTML = "X";
        action.addEventListener("click", (e) => {
            this.remove();
        });
        titleBar.appendChild(action);

        return titleBar;
    }

    /**
     * return container element
     *
     * @returns HTMLElement
     */
    getContainer() {
        let container = document.getElementById(this.containerID);
        if (container == null) {
            container = document.createElement("div");
            container.id = this.containerID;
            container.classList.add("popup-container");



            document.body.appendChild(container);
        }
        return container;
    }
}
