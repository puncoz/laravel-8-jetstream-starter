class Notification {
    static success(message) {
        window.Bus.$emit("notification", { message, type: "success" })
    }

    static info(message) {
        window.Bus.$emit("notification", { message, type: "info" })
    }

    static error(message) {
        window.Bus.$emit("notification", { message, type: "error" })
    }

    static warning(message) {
        window.Bus.$emit("notification", { message, type: "warning" })
    }
}

export default Notification;
