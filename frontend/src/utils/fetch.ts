export async function fetchAPI(url, options = {}) {
    const res = await fetch(url, options);
    return res.json();
}