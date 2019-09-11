/**
 * Return an array with pages
 * @param currentPage
 * @param numPages
 * @returns {number[]}
 */
export default function (currentPage, numPages ) {

    let current = currentPage
    let last = numPages
    let delta = 2
    let left = current - delta
    let right = current + delta + 1
    let range = []
    let rangeSpaced = []
    let l

    range.push(1)
    for (let i = current - delta; i <= current + delta; i++) {
        if (i >= left && i < right && i < numPages && i > 1) {
            range.push(i);
        }
    }
    range.push(numPages);

    for (let i of range) {
        if (l) {
            if (i - l === 2) {
                rangeSpaced.push(l + 1);
            }
        }
        rangeSpaced.push(i);
        l = i;
    }

    return rangeSpaced;
}