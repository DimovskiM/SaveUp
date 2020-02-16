import * as axios from 'axios';

const apiUrl = "http://localhost:8000/"

export const getProducts = async function() {
    const response = await axios.get(apiUrl);

    const products = response.data.map(x => {
        const product = {
            id: x.id,
            name: x.name,
            currentPrice: x.currentPrice,
            imageUrl: x.imageUrl
        }

        return product;
    });

    return products;
}

export const getProduct = async function(id) {
    const response = await axios.get(`${apiUrl}${id}`);

    const product = response.data;

    return product;
}