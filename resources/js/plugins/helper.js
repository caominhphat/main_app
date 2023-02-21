export default {
    install(app) {
        app.config.globalProperties.$helper = {
            Enum:{
                DATE_FORMAT_SHORT: "dd-MM-yyyy",
            },
        }
    }
}
