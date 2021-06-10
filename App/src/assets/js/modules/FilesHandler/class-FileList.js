import { Files } from "./class-Files.js";

/**
 * Class using satic list of Files lists.
 * /!\ Meta use !
 */
export class FileList {
    static list = {};

    /**
     * Return registred list.
     * 
     * @param {string} name 
     * @returns {Files}
     */
    static getList(name) {
        if (null == FileList.list[name]){
            FileList.list[name] = new Files(name);
        }
        return FileList.list[name];
    }
}
