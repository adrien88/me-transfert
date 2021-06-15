export class ExFile {
    constructor(file = null) {    
        if (null != file) {
            this.import(file);
        } else {
            this.file = new File();
        }
    }

    /**
     * Import file (from drag&drop or input form).
     *
     * @Param {File} file to load.
     *
     */
    import(file) {
        if (file instanceof File) {
            this.file = file;
            this.uri = URL.createObjectURL(file);
            this.async = file.async;
            this.url = file.url;
            this.name = file.name;
            this.type = file.type;
            this.lastMofified = file.lastMofified;
            this.imported = Date.now();
        }
    }

    /**
     * Import from server.
     *
     * @param {string} uri [optional]
     */
    load(url = null) {
        target = this.url ?? url;
        fetch(target, {
            method: "GET",
        })
            .then((response) => {
                if (response.ok) return response.blob();
                else {
                    console.log("File : " + uri);
                    console.log("Network error : " + response.statusText);
                }
            })
            .then((data) => {
                file = new File(data, uri);
                file.uri = uri;

                // FileList.set(file);
            })
            .catch((errors) => {
                console.log(errors);
            });
    }

    /**
     * Unlink file on server
     *
     */
    async unlink() {
        if (null != this.url) {
            let url = this.url.replace("send/", "delete/") + this.id;
            let data = new FormData();
            data.append("file.uri", this.uri);
            data.append("file.name", this.name);
            data.append("file.type", this.type);

            return await fetch(url, {
                method: "POST",
                body: data,
            })
                .then((response) => {
                    if (response.ok) return response.json();
                    else console.log("Network error : " + response.statusText);
                })
                .catch((errors) => {
                    console.log(errors);
                });
        }
    }

    /**
     * Save file on server
     *
     * @param {string} string
     */
    async save() {
        if (null != this.url) {
            let url = this.url + "/" + this.id;
            let data = new FormData();
            data.append("file.uri", this.uri);
            data.append("file.name", this.name);
            data.append("file.type", this.type);
            data.append("file.payload", this.file);

            return await fetch(url, {
                method: "POST",
                body: data,
            })
                .then((response) => {
                    if (response.ok) return response.json();
                    else console.log("Network error : " + response.statusText);
                })
                .catch((errors) => {
                    console.log(errors);
                });
        }
    }
}
