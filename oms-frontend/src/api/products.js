import request from '@/services/request';

export const getProducts = () => {
    return request({
        url: 'product',
        method: 'get'
    })
}

export const createProduct = (params) => {
    return request({
        url: 'product',
        method: 'post',
        data: params
    })
}

export const updateProduct = (params) => {
    return request({
        url: 'update/product',
        method: 'post',
        data: params
    })
}

export const deleteProduct = (params) => {
    return request({
        url: 'delete/product',
        method: 'post',
        data: params
    })
}