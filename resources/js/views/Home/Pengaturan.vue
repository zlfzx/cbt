<template>
  <v-row>
    <v-col cols="12" sm="12" md="6">
      <v-card>
        <v-card-title><v-icon>mdi-lock</v-icon> Ganti Kata Sandi</v-card-title>
        <v-divider></v-divider>
        <v-form class="pa-5">
          <v-text-field
            v-model="password_lama"
            label="Password Lama"
            outlined
          ></v-text-field>
          <v-text-field
            v-model="password_baru"
            label="Password Baru"
            outlined
          ></v-text-field>
          <v-btn color="success">
            Simpan
          </v-btn>
        </v-form>
      </v-card>
    </v-col>
  </v-row>
</template>