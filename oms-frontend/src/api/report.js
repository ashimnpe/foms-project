import request from '@/services/request';

export const getReport = (params) => {
    return request({
        url: 'daily/report',
        method: 'post',
        data: params
    })
}   