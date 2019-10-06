export default class Auth {
    constructor(user) {
        this.user = user;
    }

    roles() {
        return this.user.roles.map(role => role.name);
    }
}
