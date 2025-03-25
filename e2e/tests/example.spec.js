// @ts-check
const { test, expect } = require('@playwright/test');

test('homepage', async ({ page }) => {
  await page.goto('https://localhost/');
  await expect(page).toHaveTitle('Welcome to Kodano!');
});

test('swagger', async ({ page }) => {
  await page.goto('https://localhost/docs');
  await expect(page).toHaveTitle('Kodano - API Platform');
  await expect(page.locator('.opblock-tag span')).toHaveText([
    'Category',
    'Product'
  ]);
});

test('admin - product and category CRUD', async ({ page, browserName }) => {
  await page.goto('https://localhost/admin');

  // Create Category first
  await page.locator('.RaSidebar-fixed').getByText('Categories').click();
  await page.getByLabel('Create').click();
  await page.getByLabel('Code').fill(browserName);
  await page.getByLabel('Save').click();

  await expect(page).toHaveURL(/admin#\/categories$/);

  // Create Product
  await page.locator('.RaSidebar-fixed').getByText('Products').click();
  await page.getByLabel('Create').click();
  await page.getByLabel('Name').fill('TestProduct');
  await page.getByLabel('Price').fill('123.45');
  await page.locator('form').getByLabel('Categories').click();
  await page.getByRole('option', { name: browserName }).click();
  await page.keyboard.press('Escape');
  await page.getByLabel('Save').click();
  
  await expect(page).toHaveURL(/admin#\/products$/);

  await page.getByText('TestProduct').first().click();

  // Edit
  await page.getByLabel('Edit').first().click();
  await page.getByLabel('Name').fill('UpdatedProduct');
  await page.getByLabel('Save').click();
  await expect(page).toHaveURL(/admin#\/products$/);
  await page.getByText('UpdatedProduct').first().click();
});
