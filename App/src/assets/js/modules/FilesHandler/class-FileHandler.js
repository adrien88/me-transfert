import { FileList } from "./class-FileList.js";

/**
 *
 */
export class FileHandler {
    static indexByFileName = [];

    /**
     *
     * @param {*} source
     */
    constructor(source = null) {
       
        if (null != source) {
            if (typeof source == "string") this.load(source);
            else if (source instanceof File) this.import(source);
            else throw new Error("What is it ???");
        }
    }

    /**
     * Import from File API
     *
     * @param {*} file
     */
    import(file) {
        if (file instanceof File) {
            

            /**
             * Object stored : 
                {
                "uri": "blob:http://127.0.0.1/c8bb7ce8-d8fe-46bc-bedb-2789d5364763",
                "name": "my_file.jpg",
                "size": 118946,
                "content": null, ??
                "lastModified": 1591212300000,
                "type": "image/jpeg",
                "imported": 1618480612220,
                "blob": readableStream
                }
             */
        }
    }

    /**
     * Import from server
     *
     * @param {*} uri
     * @returns this
     */
    load(uri) {
        if (uri.match(/^https?\:\/\/([\w-_./]+)+\.[\w]{2,}/i))
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
                    file = new File(data, uri);
                    file.uri = uri;
                    // FileList.set(file);
                })
                .catch((errors) => {
                    console.log(errors);
                });
        else
            throw new Error(
                "Javascript Can't load file from '${uri}' cause url has a bad format."
            );
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
