<template>
  <div class="row">
    <div class="col-sm-12">
      <h3>Menu</h3>
      <div class="information">
        <table class="table table-striped table-hover">
          <thead>
            <tr>
              <th>name</th>
              <th>price</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="i in foodItem" :key="i">
              <td>{{i.name}}</td>
              <td>{{i.price}}</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "dashboard",
  components: {},
  methods: {},
  props: ["user"],
  data() {
    return {
      foodItem: "",
      username: "",
      orderlist: []
    };
  },
  computed: {
    timeorder: function() {
      var today = new Date().toLocaleDateString();

      return today;
    }
  },
  mounted() {
    axios
      .get("http://localhost:3000/Menu")
      .then(response => {
        this.foodItem = response.data;
        console.log(response.data);
        console.log(this.foodItem);
      })
      .catch(e => {
        this.errors.push(e);
      });
  },
  methods: {
    submit() {
      const orderinfo = {
        username: this.username,
        mess: this.mess,
        checked: this.checked,
        time: this.timeorder
      };
      //console.log(orderinfo);
      axios
        .post("http://localhost:3000/order", orderinfo)
        .then(response => {})
        .catch(e => {
          this.errors.push(e);
        });
      this.username = "";
      this.mess = "";
      this.checked = "";
    },
    check() {
      this.checked = [];
      if (!this.checkedAll) {
        for (let i in this.foodItem) {
          this.checked.push(this.foodItem[i].name);
        }
      }
    }
  }
};
</script>
<style scoped>
h3 {
  font-size: 40px;
  margin: 0 0 0 350px;
  padding: 10px;
}
h2 {
  font-size: 30px;
  margin: 0 0 0 60px;
  padding: 20px;
}
.information {
  font-size: 20px;
  line-height: 35px;
  width: 900px;
  height: 600px;
  overflow-y: scroll;
  padding: 20px;
}
.style2 {
  height: 10px;
  border: 0;
  box-shadow: 0 10px 10px -10px #8c8b8b inset;
}
</style>
