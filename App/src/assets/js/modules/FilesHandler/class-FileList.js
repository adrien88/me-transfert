

export class FileList {
    static list = {};

    /**
     *
     * @param {*} name
     * @returns
     */
    static get(name) {
        for (const key in FileList.list)
            if ((file.key = name)) return FileList.list.name;
    }

    /**
     *
     * @param {*} file
     */
    static set(file) {
        if (file instanceof File) FileList.list[file.name] = file;
    }

    /**
     *
     * @param {*} name
     */
    static unset(name) {
        FileList.list.name = null;
    }

    /**
     *
     * @param {*} name
     * @returns
     */
    static isset(name) {
        if (FileList.list.name != null) return true;
        else return false;
    }
}
