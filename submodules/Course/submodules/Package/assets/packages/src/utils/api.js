// import VueResource from 'vue-resource'

export default {
  init (obj) {
    let self = obj

    return {
      get (url, query, prefix) {

        return new Promise((resolve, reject) => {
          self.$http.get(url, query).then((response) => {
            let items = response.body
            const total = typeof response.body.data != 'undefined' ? response.body.data.total : response.body.length
            resolve({items, total, response})
          }, (response) => {
            reject({response})
          })
        })
      }
    }
  }
}
