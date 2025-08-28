# Testing Dashboard Company dengan Data Real

## Kredensial Login untuk Testing

### Company dengan Jobs (Gunakan salah satu):
1. **Lind PLC (ID: 1)** - 2 jobs
   - Email: `kiehn.donnell@example.net`
   - Password: `password`
   - Jobs: Agricultural Sales Representative, Aircraft Assembler

2. **Bartoletti LLC (ID: 2)** - 2 jobs
   - Email: `verla75@example.net`
   - Password: `password`
   - Jobs: Motion Picture Projectionist, Fraud Investigator

3. **Morar-Cremin (ID: 3)** - 2 jobs
   - Email: `alayna.bergnaum@example.net`
   - Password: `password`
   - Jobs: Professional Photographer, Law Clerk

4. **Kulas-Strosin (ID: 4)** - 1 job
   - Email: `lowe.kamille@example.org`
   - Password: `password`
   - Jobs: Postal Clerk

5. **Bauch LLC (ID: 5)** - 3 jobs
   - Email: `nash41@example.net`
   - Password: `password`
   - Jobs: Life Scientists, Animal Scientist, Postal Clerk

## Langkah Testing:

1. Buka browser dan akses: `http://127.0.0.1:8000`
2. Login dengan salah satu kredensial di atas
3. Akses dashboard company
4. Verifikasi bahwa data yang ditampilkan sesuai dengan jumlah jobs yang dimiliki company
5. Periksa log Laravel untuk melihat debug log yang menunjukkan data yang benar

## Expected Results:

- Dashboard harus menampilkan jumlah jobs yang benar (bukan 0)
- Debug log harus menunjukkan company_id yang sesuai dengan company yang login
- Total jobs, active jobs, dan applications harus menampilkan angka yang benar
- Recent jobs harus menampilkan daftar pekerjaan yang dimiliki company

## Debug Log Command:
```bash
Get-Content "c:\laragon\www\glints\storage\logs\laravel.log" | Select-String -Pattern "Dashboard|JobService|JobRepository|ApplicationService|CompanyController" | Select-Object -Last 20
```