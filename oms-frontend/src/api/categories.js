import request from '@/services/request';

export const getCategories = () => {
    return request({
        url: 'category',
        method: 'get'
    })
}