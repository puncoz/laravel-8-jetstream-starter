<template>
    <app-layout page-title="Dashboard">
        <section-view>
            Welcome to Dashboard
        </section-view>
    </app-layout>
</template>

<script>
    import SectionView from "../../Components/SectionView"
    import AppLayout   from "../../Layouts/AppLayout"

    export default {
        name: "Dashboard",

        components: { SectionView, AppLayout },
    }
</script>
