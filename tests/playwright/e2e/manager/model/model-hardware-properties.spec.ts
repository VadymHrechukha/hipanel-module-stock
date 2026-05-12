import { test } from "@hipanel-core/fixtures";
import { expect } from "@playwright/test";
import { Alert } from "@hipanel-core/shared/ui/components";

const hwProps = {
  max_ram_size: "512",
  ram_slots: "8",
  cpu_sockets: "2",
};

test.describe("Model Hardware Properties", () => {
  test("Motherboard hardware properties are saved and displayed after update @hipanel-module-stock @manager", async ({ managerPage }) => {
    // Find a motherboard model in the index
    await managerPage.goto("/stock/model/index?ModelSearch[type]=motherboard");
    const firstRow = managerPage.locator("table tbody tr").first();
    await expect(firstRow).toBeVisible();
    const modelId = await firstRow.getAttribute("data-key");
    expect(modelId, "No motherboard models found in the index").not.toBeNull();

    // Open the update form for the motherboard model
    await managerPage.goto(`/stock/model/update?id=${modelId}`);

    // The motherboard hardware properties subform should be visible on the update form
    const maxRamInput = managerPage.locator("input[id=model-0-props-motherboard-max_ram_size]");
    await expect(maxRamInput).toBeVisible();

    // Fill in the hardware property fields
    await maxRamInput.fill(hwProps.max_ram_size);
    await managerPage.locator("input[id=model-0-props-motherboard-ram_slots]").fill(hwProps.ram_slots);
    await managerPage.locator("input[id=model-0-props-motherboard-cpu_sockets]").fill(hwProps.cpu_sockets);

    // Save the form
    await managerPage.locator("button:has-text(\"Save\")").click();

    // Verify the model was updated successfully
    await Alert.on(managerPage).hasText("Model has been updated");

    // Navigate to the model view page to verify hardware properties are displayed
    await managerPage.goto(`/stock/model/view?id=${modelId}`);

    // The Hardware Properties panel loads its content via AJAX after page load.
    // Playwright auto-waits on these assertions, so they will pass once AJAX completes.
    await expect(managerPage.locator("th:has-text(\"Max RAM\") + td")).toHaveText(hwProps.max_ram_size);
    await expect(managerPage.locator("th:has-text(\"RAM slots\") + td")).toHaveText(hwProps.ram_slots);
    await expect(managerPage.locator("th:has-text(\"CPU sockets\") + td")).toHaveText(hwProps.cpu_sockets);

    // Navigate back to the update form and verify the fields are pre-populated
    await managerPage.goto(`/stock/model/update?id=${modelId}`);
    await expect(managerPage.locator("input[id=model-0-props-motherboard-max_ram_size]")).toHaveValue(hwProps.max_ram_size);
    await expect(managerPage.locator("input[id=model-0-props-motherboard-ram_slots]")).toHaveValue(hwProps.ram_slots);
    await expect(managerPage.locator("input[id=model-0-props-motherboard-cpu_sockets]")).toHaveValue(hwProps.cpu_sockets);
  });
});
