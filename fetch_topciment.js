const fs = require('node:fs');
const path = require('node:path');

const PRODUCTS = {
    microcement: [
        "sttandard",
        "evoluttion",
        "atlanttic",
        "efectto pu",
        "efectto",
        "industrial",
        "natture",
        "pure mettal",
        "classic mettal",
        "elitte",
        "acricem",
        "primacem",
        "topsealer",
        "microcement clean",
        "ceraciment",
    ],
    stamped_concrete: [
        "stonecem",
        "desmocem",
        "sealcem",
        "oxicem",
        "covercem",
        "naturcem",
        "overlay",
        "ecocleane",
        "imacem",
        "fibratop",
        "toptools"
    ],
    common: [
        "tools",
        "emottion",
        "arcocem",
    ]
}

const writeFile = (dirname, filename, json) => {
    const filePath = `./src/mock/${dirname}/${filename}.json`;
    const dirPath = path.join(__dirname, `./src/mock/${dirname}`);

    fs.mkdir(dirPath, () => {        
        fs.writeFile(filePath, json, (err) => {
            if (err) {
                console.error("Error al escribir el archivo JSON:", err);
            } else {
                console.log("Archivo JSON creado y datos escritos correctamente.");
            }
        });
    })

}

const fetchData = async(dirname, collection) => {
    const res = await fetch(`https://www.topciment.shop/api/v2/search?shop=701275880&resultsPerPage=100&page=1&locale=en_GB`, {
        "headers": {
            "accept": "application/json, text/plain, */*",
            "accept-language": "es-ES,es;q=0.9",
            "content-type": "application/json",
            "sec-ch-ua": "\"Not A(Brand\";v=\"8\", \"Chromium\";v=\"132\", \"Google Chrome\";v=\"132\"",
            "sec-ch-ua-mobile": "?0",
            "sec-ch-ua-platform": "\"Windows\"",
            "sec-fetch-dest": "empty",
            "sec-fetch-mode": "cors",
            "sec-fetch-site": "same-origin"
        },
        "referrer": "https://www.topciment.shop/en/search?q=elitte",
        "referrerPolicy": "strict-origin-when-cross-origin",
        "body": `{\"filters\":[],\"query\":\"${collection}\",\"sort\":\"relevance\"}`,
        "method": "POST",
        "mode": "cors",
        "credentials": "include"
    });

    const obj = await res.json();
    writeFile(dirname, collection, JSON.stringify(obj.products));
}

const handle = async() => {
    for(const key in PRODUCTS) {
        for await(collection of PRODUCTS[key]) {
            await fetchData(key, collection);
        }
    }
}

handle();


