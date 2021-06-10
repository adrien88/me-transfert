import { FileList } from "./class-FileList.js";

export class Files {
    list = {};
    suscribers = [];

    constructor(name) {
        this.name = name;
        if (null == FileList.list[name]) FileList.list[name] = this;
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
        for (const key in this.list) {
            if (hash == this.list[key]) {
                for (const callable of this.suscribers) {
                    callable("get", hash, this.list.key);
                }
                return this.list.key;
            }
        }
    }

    /**
     *
     * @param {*} file
     */
    set(file) {
        let name = ("" + Math.random() * 1000000).replace(".", "");
        if (file instanceof File) {
            this.list[name] = file;
            for (const callable of this.suscribers) callable("set", name, file);
        }
    }

    /**
     *
     * @param {*} name
     */
    unset(name) {
        if (this.isset(name)) {
            this.list[name] = null;
            for (const callable of this.suscribers) {
                callable("unset", name, null);
            }
        }
    }

    /**
     *
     * @param {*} key
     * @returns
     */
    isset(key) {
        if (null != this.list[key]) return true;
        else return false;
    }
}
