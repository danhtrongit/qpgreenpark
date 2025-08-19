<div class="text-center mb-8">
    <h2 class="text-2xl lg:text-4xl uppercase font-medium">
        Đăng ký
        <strong
            class="bg-gradient-to-r from-secondary-darker to-secondary-lighter inline-block text-transparent bg-clip-text">
            nhận tư vấn
        </strong>
    </h2>
</div>

<form id="contactForm" action="" class="space-y-4 border border-secondary-lighter/10 text-sm p-8 rounded-lg">
    <!-- Họ tên và Điện thoại -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
        <div class="relative">
            <input
                type="text"
                name="fullName"
                id="fullName"
                placeholder="HỌ TÊN (*)"
                class="w-full bg-transparent text-white placeholder-gray-300 border-0 border-b border-gray-400 focus:border-secondary-lighter focus:outline-none pb-3"
                required
            >
        </div>
        <div class="relative">
            <input
                type="tel"
                name="phoneNumber"
                id="phoneNumber"
                placeholder="ĐIỆN THOẠI (*)"
                class="w-full bg-transparent text-white placeholder-gray-300 border-0 border-b border-gray-400 focus:border-secondary-lighter focus:outline-none pb-3"
                required
            >
        </div>
    </div>

    <!-- Email -->
    <div class="relative">
        <input
            type="email"
            name="email"
            id="email"
            placeholder="EMAIL (*)"
            class="w-full bg-transparent text-white placeholder-gray-300 border-0 border-b border-gray-400 focus:border-secondary-lighter focus:outline-none pb-3"
            required
        >
    </div>

    <!-- Dropdown chọn loại căn hộ -->
    <div class="relative">
        <select
            name="apartmentType"
            id="apartmentType"
            class="w-full bg-transparent text-white border-0 border-b border-gray-400 focus:border-secondary-lighter focus:outline-none pb-3 appearance-none cursor-pointer"
            required
        >
            <option value="" class="bg-primary-950 text-white">CHỌN LOẠI CĂN HỘ BẠN QUAN TÂM</option>
            <option value="1pn" class="bg-primary-950 text-white">Căn hộ 1 phòng ngủ</option>
            <option value="2pn" class="bg-primary-950 text-white">Căn hộ 2 phòng ngủ</option>
            <option value="3pn" class="bg-primary-950 text-white">Căn hộ 3 phòng ngủ</option>
            <option value="penthouse" class="bg-primary-950 text-white">Penthouse</option>
            <option value="duplex" class="bg-primary-950 text-white">Duplex</option>
        </select>
    </div>

    <!-- Lời nhắn -->
    <div class="relative">
        <textarea
            name="message"
            id="message"
            rows="2"
            placeholder="LỜI NHẮN"
            class="w-full bg-transparent text-white placeholder-gray-300 border-0 border-b border-gray-400 focus:border-secondary-lighter focus:outline-none pb-3 resize-none"
        ></textarea>
    </div>

    <!-- Submit button -->
    <div class="text-center pt-4">
        <button
            type="submit"
            class="inline-flex items-center gap-3 bg-gradient-to-r from-secondary-darker to-secondary-lighter text-white px-8 py-2 rounded-full font-medium hover:from-secondary-mid hover:to-secondary-dark transition-all duration-300"
        >
            ĐĂNG KÝ NGAY
           <i class="fa-light fa-arrow-right"></i>
        </button>
    </div>
</form>
