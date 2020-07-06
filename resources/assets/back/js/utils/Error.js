class Errors {
    /**
     * Create a new Errors instance.
     */
    constructor(errors) {
        this.errors = errors
    }

    /**
     * Determine if an errors exists for the given field.
     *
     * @param {string} field
     */
    has(field) {
        const errors = this.errors
        if (field instanceof Array) {
            field.forEach(function(fieldName) {
                if (errors.hasOwnProperty(fieldName)) {
                    return errors.hasOwnProperty(fieldName)
                }
            })
        }
        return errors.hasOwnProperty(field)
    }

    /**
     * Determine if we have any errors.
     */
    any() {
        return Object.keys(this.errors).length > 0
    }

    /**
     * Return all error array
     * @returns {Array}
     */
    all() {
        const self = this
        const errorBag = []
        Object.keys(this.errors).filter(
            function(data) {
                errorBag.push(self.get(data))
            },
        )
        return errorBag
    }

    /**
     * Retrieve the error message for a field.
     *
     * @param {string} field
     */
    get(field) {
        if (this.errors[field]) {
            return Array.isArray(this.errors[field]) ? this.errors[field][0] : this.errors[field]
        }
    }

    /**
     * Clear one or all error fields.
     *
     * @param {string|null} field
     */
    clear(field) {
        if (field) {
            const arrayName = field.toString().replace(/[\[\]']+/g, ".").replace(/\.$/, "")

            delete this.errors[arrayName]

            return
        }

        this.errors = {}
    }
}

export default Errors
