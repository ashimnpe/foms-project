import request from '@/services/request';

export const getCategories = () => {
    return request({
        url: 'category',
        method: 'get'
    })
}


export const createCategory = (params) => {
    return request({
        url: 'category',
        method: 'post',
        data: params
    })
}

export const updateCategory = (params) => {
    return request({
        url: 'update/category',
        method: 'post',
        data: params
    })
}

export const deleteCategory = (params) => {
    return request({
        url: 'delete/category',
        method: 'post',
        data: params
    })
}