async function api(payload){
    const res = await fetch('?action=api', {
        method: 'POST',
        headers: {'Content-Type':'application/json'},
        body: JSON.stringify(payload)
    });
    return await res.json();
}

document.addEventListener('DOMContentLoaded',()=>{
    const form = document.getElementById('form');
    const tbl = document.getElementById('tbl').querySelector('tbody');
    const dbg = document.getElementById('debug');
    document.getElementById('save').addEventListener('click', async (e)=>{
        e.preventDefault();
        const id = document.getElementById('id').value;
        const payload = {
            action: id ? 'update' : 'create',
            id: id,
            customer: document.getElementById('customer').value,
            service: document.getElementById('service').value,
            price: parseFloat(document.getElementById('price').value),
            status: document.getElementById('status').value
        };
        const r = await api(payload);
        dbg.textContent = JSON.stringify(r, null, 2);
        if (r.status === 'ok') window.location.reload();
    });
    document.getElementById('new').addEventListener('click', (e)=>{
        document.getElementById('id').value='';
        document.getElementById('customer').value='';
        document.getElementById('service').value='';
        document.getElementById('price').value='';
    });

    tbl.addEventListener('click', async (e)=>{
        const tr = e.target.closest('tr');
        if (!tr) return;
        const id = tr.dataset.id;
        if (e.target.classList.contains('edit')){
            // populate form
            document.getElementById('id').value = id;
            document.getElementById('customer').value = tr.children[1].textContent;
            document.getElementById('service').value = tr.children[2].textContent;
            document.getElementById('price').value = tr.children[3].textContent;
            document.getElementById('status').value = tr.children[4].textContent;
        } else if (e.target.classList.contains('del')){
            if (!confirm('Delete?')) return;
            const r = await api({action:'delete', id: id});
            dbg.textContent = JSON.stringify(r, null, 2);
            if (r.status === 'ok') window.location.reload();
        }
    });
});
