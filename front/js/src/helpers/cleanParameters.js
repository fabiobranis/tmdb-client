/**
 * Clear the unnecessary parameters
 * @param obj
 * @returns {any}
 */
export default function (obj) {
    const o = Object.assign({},obj)
    for (let propName in o) {
        if (!o.hasOwnProperty(propName)) {
            continue
        }
        if (o[propName] === null || o[propName] === undefined || o[propName].length === 0) {
            delete o[propName];
        }
    }
    return o
}