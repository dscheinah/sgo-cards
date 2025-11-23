export default function (string) {
    const element = document.createElement('div');
    element.innerText = string;
    return element.innerHTML;
}
