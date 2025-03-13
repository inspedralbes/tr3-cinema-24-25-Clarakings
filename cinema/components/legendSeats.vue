<template>
    <div class="flex flex-col items-center justify-center text-center mt-3 pb-9">
    <h1 class="text-white text-3xl font-mono font-bold tracking-widest underline decoration-sky-500">Elije tus asientos</h1>
    <div class="flex flex-col md:flex-row items-center justify-center w-full p-4  md:w-4/5 mt-3 md:m-7 text-slate-300 border-t-2 border-b-2 border-slate-400">
        <div class="flex items-center mr-7 mb-2 md:mb-0">
            <Seat class="fill-green-300 md:mr-4"/>
            <h2 class="text-base md:text-xl font-mono font-bold tracking-widest mb-2 md:m-0 relative md:text-center">Seleccionado</h2>
        </div>
        <div class="flex items-center mr-7 mb-2 md:mb-0">
            <Seat class="fill-orange-100 md:mr-4"/>
            <h2 class="text-base md:text-xl font-mono font-bold tracking-widest mb-2 md:m-0 relative md:text-center">Otro Cliente</h2>
        </div>
        <div class="flex items-center mr-7 mb-2 md:mb-0">
            <Seat class="fill-slate-300 md:mr-4"/>
            <h2 class="text-base md:text-xl font-mono font-bold tracking-widest mb-2 md:m-0 relative md:text-center">Disponible</h2>
        </div>
        <div class="flex items-center mr-7 mb-2 md:mb-0">
            <Seat class="fill-red-500 md:mr-4"/>
            <h2 class="text-base md:text-xl font-mono font-bold tracking-widest mb-2 md:m-0 relative md:text-center">Ocupado</h2>
        </div>
        <div class="flex items-center mr-7 mb-2 md:mb-0">
            <Seat class="fill-yellow-500 md:mr-4"/>
            <h2 class="text-base md:text-xl font-mono font-bold tracking-widest mb-2 md:m-0 relative md:text-center">VIP</h2>
        </div>
    </div>
</div>


</template>