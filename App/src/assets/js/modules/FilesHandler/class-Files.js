import { FileList } from "./class-FileList.js";
import { ExFile } from "./class-ExFile.js";

export class Files {
    suscribers = [];

    constructor(name = "MAIN") {
        this.name = name;
        if (null == FileList.list[name]) FileList.list[name] = this;
        this.list = new Map();
    }

    /**
     *
     * @returns
     */
    length() {
        return this.list.size;
    }

    /**
     *
     * @param {*} callable
     */
    bind(callable) {
        this.suscribers.push(callable);
    }

    /**
     *
     * @param {*} name
     * @returns
     */
    get(name) {
        if (this.list.has(name)) {
            return this.list.get(name);
        }
    }

    /**
     *
     * @param {*} file
     */
    set(file) {
        
        file = new ExFile(file);
        let name = file.uri.split("/");
        file.id = name[name.length - 1];

        this.list.set(file.id, file);

        console.log(file.async);
        if (file.async) file.save();

        for (const callable of this.suscribers) {
            callable("set", file.id, file);
        }
    }

    /**
     *
     * @param {*} name
     */
    unset(name) {
        if (this.list.has(name)) {
            if (this.get(name).async) this.get(name).unlink();

            for (const callable of this.suscribers) {
                callable("unset", name, this.get(name));
            }
            this.list.delete(name);
        }
    }

    /**
     *
     * @param {*} key
     * @returns
     */
    isset(key) {
        return this.list.has(key);
    }
}
