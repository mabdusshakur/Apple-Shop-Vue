<div class="section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="heading_s4 text-center">
                    <h2>Top Brands</h2>
                </div>
                <p class="leads text-center">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus blandit massa enim Nullam nunc varius.</p>
            </div>
        </div>
        <div class="row align-items-center" id="TopBrandItem">

        </div>
    </div>
</div>

<script>
    async function TopBrands() {
        let res = await axios.get("/api/brands");
        res = res.data[0];

        $("#TopBrandItem").empty()

        res.forEach((item, i) => {
            let EachItem = `<div class="p-2 col-2">
                <div class="item">
                    <div class="categories_box">
                        <a href="/product-by-brand?id=${item['id']}">
                            <img src="${item['image']}" alt="brand-image"/>
                            <span>${item['name']}</span>
                        </a>
                    </div>
                </div>
            </div>`
            $("#TopBrandItem").append(EachItem);
        })
    }
</script>
