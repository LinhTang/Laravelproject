<template>
  <div id="user">
    <v-data-table :headers="headers" :items="tableData" sort-by="name" class="elevation-1">
      <template v-slot:top>
        <v-toolbar flat color="white">
          <v-toolbar-title>User list</v-toolbar-title>
          <v-divider class="mx-4" inset vertical></v-divider>
          <div class="flex-grow-1"></div>
          <v-dialog v-model="dialog" max-width="500px">
            <template v-slot:activator="{ on }">
              <v-btn color="primary" dark class="mb-2" v-on="on">New Item</v-btn>
            </template>
            <v-card>
              <v-card-title>
                <span class="headline">{{ formTitle }}</span>
              </v-card-title>

              <v-card-text>
                <v-container grid-list-md>
                  <v-layout wrap>
                    <v-flex xs12>
                      <v-text-field v-model="editedItem.name" label="Name"></v-text-field>
                    </v-flex>
                    <v-flex xs12>
                      <v-text-field v-model="editedItem.email" label="Email"></v-text-field>
                    </v-flex>
                    <v-flex xs12>
                      <v-text-field v-model="editedItem.password" label="Password"></v-text-field>
                    </v-flex>
                    <v-flex xs12>
                      <v-text-field v-model="editedItem.confirm_password" label="Confirm password"></v-text-field>
                    </v-flex>
                    <v-flex xs12>
                      <h3>Roles</h3>
                      <v-select
                        combobox
                        v-model="editedItem.role"
                        :items="allRoles"
                        label="Roles"
                        item-text="name"
                        return-object
                        chips
                      ></v-select>
                    </v-flex>
                  </v-layout>
                </v-container>
              </v-card-text>

              <v-card-actions>
                <div class="flex-grow-1"></div>
                <v-btn color="blue darken-1" text @click="close">Cancel</v-btn>
                <v-btn color="blue darken-1" text @click="save">Save</v-btn>
              </v-card-actions>
            </v-card>
          </v-dialog>
        </v-toolbar>
      </template>

      <template v-slot:item.action="{ item }">
        <v-icon small class="mr-2" @click="editItem(item)">edit</v-icon>
        <v-icon small @click="deleteItem(item)">delete</v-icon>
      </template>
      <template v-slot:no-data>
        <v-btn color="primary" @click="initialize">Reset</v-btn>
      </template>
    </v-data-table>
  </div>
</template>

<script>
export default {
  data: () => ({
    dialog: false,
    headers: [
      { text: "Username", value: "name" },
      { text: "Email", value: "email" },
      { text: "Role", value: "role" },
      { text: "Created", value: "created_at" },
      { text: "Actions", value: "action", sortable: false }
    ],
    tableData: [],
    editedIndex: -1,
    allRoles: [],
    editedItem: {
      name: "",
      email: "",
      role: {},
      created_at: ""
    },
    defaultItem: {
      name: "",
      email: "",
      role: {},
      created_at: ""
    }
  }),

  computed: {
    formTitle() {
      return this.editedIndex === -1 ? "New Item" : "Edit Item";
    }
  },

  watch: {
    dialog(val) {
      val || this.close();
    }
  },

  created() {
    this.initialize();
  },

  methods: {
    initialize() {
      axios.get("/api/users").then(response => {
        this.tableData = response.data.data;
      });
      axios
        .get("/api/roles")
        .then(response => (this.allRoles = response.data.data));
    },

    editItem(item) {
      this.editedIndex = this.tableData.indexOf(item);
      this.editedItem = Object.assign({}, item);
      this.dialog = true;
    },

    deleteItem(item) {
      const index = this.tableData.indexOf(item);
      confirm("Are you sure you want to delete this item?") &&
        this.tableData.splice(index, 1);

      axios
        .delete("/api/users/" + item.id)
        .then(response => console.log(response.data));
    },

    close() {
      this.dialog = false;
      setTimeout(() => {
        this.editedItem = Object.assign({}, this.defaultItem);
        this.editedIndex = -1;
      }, 300);
    },

    save() {
      if (this.editedIndex > -1) {
        Object.assign(this.tableData[this.editedIndex], this.editedItem);

        axios
          .put("/api/users/" + this.editedItem.id, this.editedItem)
          .then(response => console.log(response.data));
      } else {
        this.tableData.push(this.editedItem);

        axios
          .post("/api/users", this.editedItem)
          .then(response => console.log(response.data));
      }
      this.close();
    }
  }
};
</script>
<style scoped>
#user {
  margin: 100px 0 0 0;
}
</style>