import { FileList } from "./class-FileList.js";

/**
 *
 */
export class FileHandler {
    static FilesList = [];
    static indexByFileName = [];

    /**
     *
     * @param {*} source
     */
    constructor(source = null) {
        this.uri = null;
        this.filename = null;
        this.size = null;
        this.content = null;
        this.lastModified = null;

        if (source != null) {
            if (typeof source == "string")
                if (source.match(/^https?\:\/\/([\w-_./])+\.[\w\.]{2,}/i))
                    this.load(source);
                else
                    throw new Error(
                        "Javascript Can't load file from '${source}' cause url has a bad format."
                    );
            else if (source instanceof File) this.import(source);
            else throw new Error("What is it ???");
        }
    }

    /**
     * Import from File API
     *
     * @param {*} file
     */
    import(file, callback) {
        if (file instanceof File) {
            this.uri = URL.createObjectURL(file); //  unique key random generator
            this.filename = file.name;
            this.type = file.type; // mime: image/jpeg
            this.imported = Date.now(); // int: date importation
            this.lastModified = file.lastModified;
            this.size = file.size; // int size
            this.blob = file.stream(); // content

            /**
             * Object stored : 
                {
                "uri": "blob:http://127.0.0.1/c8bb7ce8-d8fe-46bc-bedb-2789d5364763",
                "filename": "6144294188_762c20ab58_o.jpg",
                "size": 118946,
                "content": null,
                "lastModified": 1591212300000,
                "type": "image/jpeg",
                "imported": 1618480612220,
                "blob": readableStream
                }
             */

            /**
             * escape duplicata
             */
            for (const rgt of FileHandler.FilesList) {
                let mssg =
                    "L'objet a déjà été importé : souhaitez vous l'écraser ?";
                if (
                    rgt.filename == this.filename &&
                    rgt.lastModified == this.lastModified
                ) {
                    if (confirm(mssg)) FileHandler.FilesList.push(this);
                    else break;                    
                } else {
                    FileHandler.FilesList.push(this);
                }
            }
        }
    }

    /**
     * Import from server
     *
     * @param {*} uri
     * @returns this
     */
    load(uri, callback) {
        fetch(uri, {
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
                console.log(data);

                this.uri = uri;
                this.filename = uri.split("/")[uri.length - 1];

                // this.content = response.blob();
                // FileHandler.FilesList.push(this);
            })
            .catch((errors) => {
                console.log(errors);
            })
            .finally(() => {
                if (callback != null) callback(this);
            });
    }

    /**
     *
     * @param {*} callback
     * @returns this
     */
    save(uriBackScript, callback) {
        data = new FormData();
        data.append("uri", this.uri);
        data.append("filename", this.filename);
        data.append("content", this.content);

        fetch(uriBackScript, {
            method: "POST",
            body: data,
        })
            .then((response) => {
                if (response.ok) this.data = response.json();
                else console.log("Network error : " + response.statusText);
            })
            .then((data) => {})
            .catch((errors) => {
                console.log(errors);
            })
            .finally(() => {
                if (callback != null) callback(this.data);
            });
    }
}
