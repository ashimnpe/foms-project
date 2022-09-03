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