export class Titlebar {
    constructor() {
        let titleBar = document.createElement("div");
        titleBar.classList.add("titleBar");

        let title = document.createElement("div");
        title.classList.add("title");
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
}
